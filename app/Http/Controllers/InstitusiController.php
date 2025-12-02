<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Institusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstitusiController extends Controller
{
    public function index()
    {
        $institusis = Institusi::all();
        return view('divisions.index', compact('institusis'));
    }

    public function create()
    {
        return view('divisions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name',
        ]);

        // Cek apakah tabel divisions kosong
        if (Institusi::count() === 0) {
            // Reset auto-increment ke 1
            DB::statement('ALTER TABLE divisions AUTO_INCREMENT = 1');
        }

        // Membuat Division baru
        Institusi::create($request->only('name'));

        return redirect()->route('institusis.index')->with('success', 'Divisi berhasil ditambahkan.');
    }

    

    public function edit(Institusi $institusi)
    {
        return view('divisions.edit', compact('institusi'));
    }

    public function update(Request $request, Institusi $institusi)
    {
        $request->validate([
            'name' => 'required|unique:divisions,name,' . $institusi->id . '|max:255',
        ]);

        $institusi->update($request->all());

        return redirect()->route('institusis.index')->with('success', 'Division updated successfully!');
    }

    public function destroy(Institusi $institusi)
    {
        $institusi->delete();

        return redirect()->route('institusis.index')->with('success', 'Division deleted successfully!');
    }

    public function units(Institusi $institusi)
    {
        $institusi->load('unit_karyas'); // Mengambil unit_karyas dalam divisi
        return view('divisions.units', compact('institusi'));
    }

}
