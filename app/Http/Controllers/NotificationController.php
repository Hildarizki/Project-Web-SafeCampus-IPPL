<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    // GET /api/notifications
    public function index(Request $request): JsonResponse
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(20);
 
        $unreadCount = Notification::where('user_id', $request->user()->id)
            ->where('is_read', false)
            ->count();
 
        return response()->json([
            'data'         => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }
 
    // PATCH /api/notifications/{id}/read
    public function markRead(Request $request, string $id): JsonResponse
    {
        $notification = Notification::where('user_id', $request->user()->id)
            ->findOrFail($id);
 
        $notification->update([
            'is_read' => true,
            'read_at' => Carbon::now(),
        ]);
 
        return response()->json(['message' => 'Notifikasi ditandai sudah dibaca']);
    }
 
    // PATCH /api/notifications/read-all
    public function markAllRead(Request $request): JsonResponse
    {
        Notification::where('user_id', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => Carbon::now()]);
 
        return response()->json(['message' => 'Semua notifikasi ditandai sudah dibaca']);
    }
}
