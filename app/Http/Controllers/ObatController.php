<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('dokter.obat.index', compact('obat'));
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // redirect ke halaman login
}

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index');
    }

    public function edit(Obat $obat)
    {
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required'
        ]);

        $obat->update($request->all());
        return redirect()->route('obat.index');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index');
    }

    
}
