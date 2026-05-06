<?php

namespace App\Http\Controllers;

use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CounselorController extends Controller
{
     // GET /api/counselors/available  (mahasiswa: cari konselor yang online)
    public function available(): JsonResponse
    {
        $counselors = Counselor::with('user:id,name,email')
            ->where('is_available', true)
            ->get()
            ->map(function ($c) {
                return [
                    'id'           => $c->id,
                    'name'         => $c->user->name,
                    'spesialisasi' => $c->spesialisasi,
                    'bio'          => $c->bio,
                ];
            });
 
        return response()->json(['data' => $counselors]);
    }
 
    // PATCH /api/counselor/availability  (konselor: toggle online/offline)
    public function updateAvailability(Request $request): JsonResponse
    {
        $request->validate([
            'is_available' => 'required|boolean',
        ]);
 
        $counselor = $request->user()->counselor;
 
        if (!$counselor) {
            return response()->json(['message' => 'Profil konselor tidak ditemukan'], 404);
        }
 
        $counselor->update(['is_available' => $request->boolean('is_available')]);
 
        return response()->json([
            'message'      => 'Status diperbarui',
            'is_available' => $counselor->is_available,
        ]);
    }
}
