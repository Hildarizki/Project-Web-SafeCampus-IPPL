<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // POST /api/register
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => ['required', 'confirmed', Password::min(8)],
            'role'          => 'required|in:mahasiswa,konselor,admin',
            'phone'         => 'nullable|string|max:20',
            // Field mahasiswa
            'nim'           => 'required_if:role,mahasiswa|string|unique:students,nim',
            'program_studi' => 'required_if:role,mahasiswa|string',
            'fakultas'      => 'nullable|string',
            'angkatan'      => 'nullable|integer',
            // Field konselor
            'spesialisasi'  => 'nullable|string',
            'bio'           => 'nullable|string',
            'no_lisensi'    => 'nullable|string',
        ]);
 
        // Buat user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password, // auto-hashed via cast
            'role'     => $request->role,
            'phone'    => $request->phone,
        ]);
 
        // Buat profile sesuai role
        if ($request->role === 'mahasiswa') {
            Student::create([
                'user_id'       => $user->id,
                'nim'           => $request->nim,
                'program_studi' => $request->program_studi,
                'fakultas'      => $request->fakultas,
                'angkatan'      => $request->angkatan,
            ]);
        }
 
        if ($request->role === 'konselor') {
            Counselor::create([
                'user_id'      => $user->id,
                'spesialisasi' => $request->spesialisasi,
                'bio'          => $request->bio,
                'no_lisensi'   => $request->no_lisensi,
            ]);
        }
 
        $token = $user->createToken('auth_token')->plainTextToken;
 
        return response()->json([
            'message' => 'Registrasi berhasil',
            'token'   => $token,
            'user'    => $user->load(['student', 'counselor']),
        ], 201);
    }
 
    // POST /api/login
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);
 
        $user = User::where('email', $request->email)->first();
 
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
            ], 401);
        }
 
        // Hapus token lama, buat yang baru
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
 
        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => $user->load(['student', 'counselor']),
        ]);
    }
 
    // POST /api/logout
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
 
        return response()->json(['message' => 'Logout berhasil']);
    }
 
    // GET /api/me
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user()->load(['student', 'counselor']),
        ]);
    }
 
    // GET /api/users  (admin only)
    public function listUsers(Request $request): JsonResponse
    {
        $users = User::with(['student', 'counselor'])
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->paginate(15);
 
        return response()->json($users);
    }
 
    // PATCH /api/users/{id}/verify  (admin only)
    public function verifyUser(string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->update(['is_verified' => true]);
 
        return response()->json(['message' => 'User berhasil diverifikasi', 'user' => $user]);
    }
}
