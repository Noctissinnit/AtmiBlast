<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Institusi;
use App\Models\UnitKarya;
use Illuminate\Http\Request;

class UnitKaryaController extends Controller
{
    // Menampilkan form tambah unit karya
    public function create()
    {
        $institusis = Institusi::all(); // Ambil semua divisi
        $units = collect(); // Jika tidak ada divisi yang dipilih, unit tetap kosong
        return view('units.create', compact('institusis', 'units'));
    }

    public function index()
    {
        $units = UnitKarya::with('institusi')->get();
        return view('units.index', compact('units'));
    }


    // Menyimpan unit karya baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_unit_karya' => 'required|string|max:255',
            'institusi_id' => 'required|exists:divisions,id',
        ]);
    
        // Simpan unit karya
        $unitKarya = UnitKarya::create([
            'nama_unit' => $request->nama_unit,
            'institusi_id' => $request->institusi_id,
        ]);

        if ($unitKarya) {
            return redirect()->route('units.create')->with('success', 'Unit Karya berhasil ditambahkan!');
        }
    
        return back()->with('error', 'Gagal menambahkan unit karya.');
    }
    // Di Controller Anda
    public function getUnitsByDivision($institusi_id)
    {
        // Ambil unit karya berdasarkan division_id
        $units = UnitKarya::where('division_id', $institusi_id)->get();

        // Kirim kembali response JSON
        return response()->json($units);
    }


}
