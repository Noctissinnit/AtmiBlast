<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return view('divisions.index', compact('divisions'));
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
    
        // Membuat Division baru
        Division::create($request->only('name'));
    
        return redirect()->route('divisions.index')->with('success', 'Divisi berhasil ditambahkan.');
    }
    

    public function edit(Division $division)
    {
        return view('divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => 'required|unique:divisions,name,' . $division->id . '|max:255',
        ]);

        $division->update($request->all());

        return redirect()->route('divisions.index')->with('success', 'Division updated successfully!');
    }

    public function destroy(Division $division)
    {
        $division->delete();

        return redirect()->route('divisions.index')->with('success', 'Division deleted successfully!');
    }
}
