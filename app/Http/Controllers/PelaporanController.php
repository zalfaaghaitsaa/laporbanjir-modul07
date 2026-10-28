<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    public function create()
    {
        return view('lapor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:255',
            'tinggi_air'   => 'required|integer|min:0',
            'keterangan'   => 'nullable|string',
            'foto'         => 'required|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $path = $request->file('foto')->store('laporan', 'public');

        Laporan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'no_hp'        => $request->no_hp,
            'lokasi'       => $request->lokasi,
            'kecamatan'    => $request->kecamatan,
            'tinggi_air'   => $request->tinggi_air,
            'keterangan'   => $request->keterangan,
            'foto'         => $path,
            'status'       => 'Menunggu', 
        ]);

        return redirect()->route('lapor.create')
            ->with('success', 'Laporan banjir berhasil dikirim. Terima kasih atas laporan Anda.');
    }
}