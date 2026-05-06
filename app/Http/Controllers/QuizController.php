<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QuizController extends Controller
{
    // GET /api/quizzes
    public function index(): JsonResponse
    {
        $quizzes = Quiz::where('is_active', true)->get();
        return response()->json(['data' => $quizzes]);
    }
 
    // GET /api/quizzes/{id}
    public function show(string $id): JsonResponse
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return response()->json(['data' => $quiz]);
    }
 
    // POST /api/quizzes/{id}/submit  (mahasiswa: submit jawaban kuis)
    public function submit(Request $request, string $id): JsonResponse
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
 
        $request->validate([
            'jawaban'   => 'required|array',
            'jawaban.*' => 'required|integer|min:0',
        ]);
 
        $totalSkor = 0;
        $detail    = [];
 
        foreach ($quiz->questions as $question) {
            $skorJawaban = $request->jawaban[$question->id] ?? 0;
            $totalSkor  += $skorJawaban;
 
            $detail[] = [
                'question_id' => $question->id,
                'pertanyaan'  => $question->pertanyaan,
                'skor'        => $skorJawaban,
            ];
        }
 
        // Interpretasi berdasarkan skor
        [$interpretasi, $saran] = $this->interpretasi($totalSkor, $quiz->questions->count());
 
        $result = QuizResult::create([
            'user_id'        => $request->user()->id,
            'quiz_id'        => $quiz->id,
            'skor'           => $totalSkor,
            'interpretasi'   => $interpretasi,
            'saran'          => $saran,
            'detail_jawaban' => $detail,
        ]);
 
        return response()->json([
            'message'      => 'Kuis selesai',
            'skor'         => $totalSkor,
            'interpretasi' => $interpretasi,
            'saran'        => $saran,
            'data'         => $result,
        ]);
    }
 
    // GET /api/quiz-results  (mahasiswa: riwayat kuis sendiri)
    public function myResults(Request $request): JsonResponse
    {
        $results = QuizResult::with('quiz')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();
 
        return response()->json(['data' => $results]);
    }
 
    // POST /api/quizzes  (admin: buat kuis baru)
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'judul'                     => 'required|string',
            'deskripsi'                 => 'nullable|string',
            'pertanyaan'                => 'required|array|min:1',
            'pertanyaan.*.teks'         => 'required|string',
            'pertanyaan.*.opsi_jawaban' => 'required|array|min:2',
        ]);
 
        $quiz = Quiz::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);
 
        foreach ($request->pertanyaan as $index => $item) {
            QuizQuestion::create([
                'quiz_id'       => $quiz->id,
                'pertanyaan'    => $item['teks'],
                'urutan'        => $index + 1,
                'opsi_jawaban'  => $item['opsi_jawaban'],
            ]);
        }
 
        return response()->json([
            'message' => 'Kuis berhasil dibuat',
            'data'    => $quiz->load('questions'),
        ], 201);
    }
 
    // PUT /api/quizzes/{id}  (admin)
    public function update(Request $request, string $id): JsonResponse
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->only(['judul', 'deskripsi', 'is_active']));
 
        return response()->json(['message' => 'Kuis diperbarui', 'data' => $quiz]);
    }
 
    // ---- Helper interpretasi skor ----
    private function interpretasi(int $skor, int $jumlahSoal): array
    {
        $persentase = $jumlahSoal > 0 ? ($skor / ($jumlahSoal * 3)) * 100 : 0;
 
        if ($persentase <= 30) {
            return [
                'Tingkat stres rendah',
                'Kondisi kamu baik. Pertahankan pola hidup sehat dan tetap terhubung dengan orang-orang di sekitar kamu.',
            ];
        } elseif ($persentase <= 60) {
            return [
                'Tingkat stres sedang',
                'Kamu mungkin mengalami beberapa tekanan. Pertimbangkan untuk berbicara dengan konselor atau teman terpercaya.',
            ];
        } else {
            return [
                'Tingkat stres tinggi',
                'Kami menyarankan kamu segera menghubungi konselor kampus untuk mendapatkan dukungan lebih lanjut.',
            ];
        }
    }
}
