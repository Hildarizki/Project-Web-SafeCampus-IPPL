<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class ChatController extends Controller
{
    // POST /api/conversations  (mahasiswa: mulai percakapan)
    public function startConversation(Request $request): JsonResponse
    {
        $request->validate([
            'counselor_id' => 'required|exists:counselors,id',
            'report_id'    => 'nullable|exists:reports,id',
            'is_emergency' => 'boolean', // true = panic button
        ]);
 
        $student = $request->user()->student;
        if (!$student) {
            return response()->json(['message' => 'Profil mahasiswa tidak ditemukan'], 404);
        }
 
        // Cek apakah sudah ada percakapan aktif dengan konselor yang sama
        $existing = Conversation::where('student_id', $student->id)
            ->where('counselor_id', $request->counselor_id)
            ->where('is_active', true)
            ->first();
 
        if ($existing) {
            return response()->json(['message' => 'Percakapan sudah aktif', 'data' => $existing]);
        }
 
        $conversation = Conversation::create([
            'student_id'   => $student->id,
            'counselor_id' => $request->counselor_id,
            'report_id'    => $request->report_id,
            'is_emergency' => $request->boolean('is_emergency', false),
            'is_active'    => true,
        ]);
 
        // Notifikasi ke konselor
        $counselorUserId = $conversation->counselor->user_id;
        $judul = $request->boolean('is_emergency')
            ? '🚨 PANIC BUTTON - Butuh Bantuan Segera!'
            : 'Percakapan Baru dari Mahasiswa';
 
        Notification::create([
            'user_id' => $counselorUserId,
            'judul'   => $judul,
            'pesan'   => $request->boolean('is_emergency')
                ? 'Seorang mahasiswa membutuhkan bantuan darurat segera!'
                : 'Ada mahasiswa yang ingin berkonsultasi dengan kamu.',
            'tipe'    => $request->boolean('is_emergency') ? 'panic_button' : 'percakapan_baru',
            'data'    => ['conversation_id' => $conversation->id],
        ]);
 
        return response()->json([
            'message' => 'Percakapan dimulai',
            'data'    => $conversation->load(['student.user', 'counselor.user']),
        ], 201);
    }
 
    // GET /api/conversations  (mahasiswa atau konselor: lihat daftar percakapan)
    public function myConversations(Request $request): JsonResponse
    {
        $user = $request->user();
 
        if ($user->isMahasiswa()) {
            $student = $user->student;
            $conversations = Conversation::with(['counselor.user', 'messages' => fn($q) => $q->latest()->limit(1)])
                ->where('student_id', $student?->id)
                ->latest()
                ->get();
        } else {
            $counselor = $user->counselor;
            $conversations = Conversation::with(['student.user', 'messages' => fn($q) => $q->latest()->limit(1)])
                ->where('counselor_id', $counselor?->id)
                ->latest()
                ->get();
        }
 
        return response()->json(['data' => $conversations]);
    }
 
    // GET /api/conversations/{id}
    public function showConversation(Request $request, string $id): JsonResponse
    {
        $conversation = Conversation::with(['student.user', 'counselor.user', 'messages.sender'])
            ->findOrFail($id);
 
        // Pastikan hanya participant yang bisa akses
        $this->authorizeConversation($request->user(), $conversation);
 
        // Tandai pesan sebagai sudah dibaca
        Message::where('conversation_id', $id)
            ->where('sender_id', '!=', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => Carbon::now()]);
 
        return response()->json(['data' => $conversation]);
    }
 
    // POST /api/conversations/{id}/messages
    public function sendMessage(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'pesan' => 'required|string|max:5000',
        ]);
 
        $conversation = Conversation::findOrFail($id);
        $this->authorizeConversation($request->user(), $conversation);
 
        if (!$conversation->is_active) {
            return response()->json(['message' => 'Percakapan sudah berakhir'], 422);
        }
 
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $request->user()->id,
            'pesan'           => $request->pesan,
            'is_encrypted'    => true,
            'sent_at'         => Carbon::now(),
        ]);
 
        // Notifikasi ke penerima
        $receiverId = $request->user()->id === $conversation->student->user_id
            ? $conversation->counselor->user_id
            : $conversation->student->user_id;
 
        Notification::create([
            'user_id' => $receiverId,
            'judul'   => 'Pesan Baru',
            'pesan'   => 'Kamu mendapat pesan baru.',
            'tipe'    => 'pesan_baru',
            'data'    => ['conversation_id' => $conversation->id],
        ]);
 
        return response()->json([
            'message' => 'Pesan terkirim',
            'data'    => $message->load('sender'),
        ], 201);
    }
 
    // PATCH /api/conversations/{id}/end  (konselor: akhiri percakapan)
    public function endConversation(Request $request, string $id): JsonResponse
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->update([
            'is_active' => false,
            'ended_at'  => Carbon::now(),
        ]);
 
        // Notifikasi ke mahasiswa
        Notification::create([
            'user_id' => $conversation->student->user_id,
            'judul'   => 'Sesi Konseling Selesai',
            'pesan'   => 'Sesi konseling kamu telah berakhir.',
            'tipe'    => 'sesi_selesai',
            'data'    => ['conversation_id' => $conversation->id],
        ]);
 
        return response()->json(['message' => 'Percakapan diakhiri', 'data' => $conversation]);
    }
 
    // Helper: pastikan user adalah participant conversation
    private function authorizeConversation($user, Conversation $conversation): void
    {
        $isStudent  = $user->isMahasiswa() && $user->student?->id === $conversation->student_id;
        $isKonselor = $user->isKonselor() && $user->counselor?->id === $conversation->counselor_id;
        $isAdmin    = $user->isAdmin();
 
        if (!$isStudent && !$isKonselor && !$isAdmin) {
            abort(403, 'Akses ditolak');
        }
    }
}
