<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportEvidence;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // GET /api/reports  (konselor: lihat semua laporan masuk)
    public function index(Request $request): JsonResponse
    {
        $reports = Report::with(['evidences', 'counselor.user'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->jenis, fn($q) => $q->where('jenis_bullying', $request->jenis))
            // Sembunyikan student jika laporan anonim
            ->get()
            ->map(function ($report) {
                if ($report->is_anonymous) {
                    $report->makeHidden(['student_id']);
                    $report->student = null;
                } else {
                    $report->load('student.user');
                }
                return $report;
            });
 
        return response()->json(['data' => $reports]);
    }
 
    // GET /api/reports/my  (mahasiswa: lihat laporan milik sendiri)
    public function myReports(Request $request): JsonResponse
    {
        $student = $request->user()->student;
 
        if (!$student) {
            return response()->json(['message' => 'Profil mahasiswa tidak ditemukan'], 404);
        }
 
        $reports = Report::with(['evidences', 'counselor.user'])
            ->where('student_id', $student->id)
            ->latest()
            ->get();
 
        return response()->json(['data' => $reports]);
    }
 
    // GET /api/reports/{id}
    public function show(Request $request, string $id): JsonResponse
    {
        $report = Report::with(['evidences', 'counselor.user'])->findOrFail($id);
 
        // Mahasiswa hanya bisa lihat laporan miliknya
        if ($request->user()->isMahasiswa()) {
            $student = $request->user()->student;
            if ($report->student_id !== $student?->id) {
                return response()->json(['message' => 'Akses ditolak'], 403);
            }
        }
 
        if ($report->is_anonymous) {
            $report->makeHidden(['student_id']);
            $report->student = null;
        } else {
            $report->load('student.user');
        }
 
        return response()->json(['data' => $report]);
    }
 
    // POST /api/reports  (mahasiswa: buat laporan baru)
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'jenis_bullying'   => 'required|in:verbal,fisik,siber,lainnya',
            'deskripsi'        => 'required|string|min:20',
            'lokasi'           => 'nullable|string|max:255',
            'is_anonymous'     => 'boolean',
            'tanggal_kejadian' => 'nullable|date',
            'evidences'        => 'nullable|array',
            'evidences.*'      => 'file|mimes:jpg,jpeg,png,mp4,pdf|max:10240', // max 10MB
        ]);
 
        $student = $request->user()->student;
 
        if (!$student) {
            return response()->json(['message' => 'Profil mahasiswa tidak ditemukan'], 404);
        }
 
        $report = Report::create([
            'student_id'       => $student->id,
            'jenis_bullying'   => $request->jenis_bullying,
            'deskripsi'        => $request->deskripsi,
            'lokasi'           => $request->lokasi,
            'is_anonymous'     => $request->boolean('is_anonymous', false),
            'status'           => 'menunggu',
            'tanggal_kejadian' => $request->tanggal_kejadian,
        ]);
 
        // Upload bukti jika ada
        if ($request->hasFile('evidences')) {
            foreach ($request->file('evidences') as $file) {
                $path = $file->store('evidences', 'public');
                ReportEvidence::create([
                    'report_id'   => $report->id,
                    'nama_file'   => $file->getClientOriginalName(),
                    'url_file'    => Storage::url($path),
                    'tipe_file'   => $file->getMimeType(),
                    'ukuran_file' => $file->getSize(),
                ]);
            }
        }
 
        // Notifikasi ke semua konselor
        \App\Models\User::where('role', 'konselor')->each(function ($konselor) use ($report) {
            Notification::create([
                'user_id' => $konselor->id,
                'judul'   => 'Laporan Baru Masuk',
                'pesan'   => 'Ada laporan bullying baru yang perlu ditangani.',
                'tipe'    => 'laporan_baru',
                'data'    => ['report_id' => $report->id],
            ]);
        });
 
        return response()->json([
            'message' => 'Laporan berhasil dikirim',
            'data'    => $report->load('evidences'),
        ], 201);
    }
 
    // PATCH /api/reports/{id}/status  (konselor: update status laporan)
    public function updateStatus(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'status'           => 'required|in:diterima,diproses,selesai,ditolak',
            'catatan_konselor' => 'nullable|string',
        ]);
 
        $report = Report::findOrFail($id);
        $report->update([
            'status'           => $request->status,
            'catatan_konselor' => $request->catatan_konselor,
        ]);
 
        // Notifikasi ke mahasiswa pelapor (jika tidak anonim)
        if (!$report->is_anonymous && $report->student) {
            Notification::create([
                'user_id' => $report->student->user_id,
                'judul'   => 'Status Laporan Diperbarui',
                'pesan'   => 'Status laporan kamu telah diubah menjadi: ' . $request->status,
                'tipe'    => 'status_update',
                'data'    => ['report_id' => $report->id, 'status' => $request->status],
            ]);
        }
 
        return response()->json(['message' => 'Status diperbarui', 'data' => $report]);
    }
 
    // PATCH /api/reports/{id}/assign  (konselor: ambil laporan untuk ditangani)
    public function assignToSelf(Request $request, string $id): JsonResponse
    {
        $report = Report::findOrFail($id);
        $counselor = $request->user()->counselor;
 
        if (!$counselor) {
            return response()->json(['message' => 'Profil konselor tidak ditemukan'], 404);
        }
 
        $report->update([
            'counselor_id' => $counselor->id,
            'status'       => 'diterima',
        ]);
 
        return response()->json(['message' => 'Laporan berhasil diambil', 'data' => $report]);
    }
}
