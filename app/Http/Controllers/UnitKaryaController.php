<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\UnitKarya;
use Illuminate\Http\Request;

class UnitKaryaController extends Controller
{
    // Menampilkan form tambah unit karya
    public function create()
    {
        $divisions = Division::all(); // Ambil semua divisi
        return view('units.create', compact('divisions'));
    }

    // Menyimpan unit karya baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_unit_karya' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);
    
        // Simpan unit karya
        $unitKarya = UnitKarya::create([
            'nama_unit_karya' => $request->nama_unit_karya,
            'division_id' => $request->division_id,
        ]);

        if ($unitKarya) {
            return redirect()->route('units.create')->with('success', 'Unit Karya berhasil ditambahkan!');
        }
    
        return back()->with('error', 'Gagal menambahkan unit karya.');
    }
}
