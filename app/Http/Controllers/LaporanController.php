<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IIlluminate\Support\Facades\Auth;
use App\Models\Laporan;
class LaporanController extends Controller
{
    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required'
        ]);

        Laporan::create([
            'user_id' => auth()->id(),
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'anonim' => $request->anonim ? true : false,
            'status' => 'menunggu'
        ]);

        return back()->with('success', 'Laporan berhasil dikirim');
    }
}