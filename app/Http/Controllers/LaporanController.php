<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest()->paginate(5);
        return view('laporan.index', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $statusList = ['Menunggu', 'Diproses', 'Selesai'];
        return view('laporan.edit', compact('laporan', 'statusList'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:255',
            'tinggi_air'   => 'required|integer|min:0',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:Menunggu,Diproses,Selesai',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(
            'nama_pelapor', 'no_hp', 'lokasi', 'kecamatan',
            'tinggi_air', 'keterangan', 'status'
        );

        if ($request->hasFile('foto')) {                     
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto); 
            }
            $data['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto); 
        }
        $laporan->delete();                                  

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}