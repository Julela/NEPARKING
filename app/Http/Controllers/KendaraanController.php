<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index() {
        $kendaraan = Kendaraan::where('user_id', Auth::id())->get();
        return view('kendaraan.index', compact('kendaraan'));
    }

    public function create() {
        return view('kendaraan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_plat' => 'required|unique:kendaraan',
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tipe' => 'required|in:Motor,Mobil'
        ]);

        Kendaraan::create([
            'user_id' => Auth::id(),
            'nomor_plat' => $request->nomor_plat,
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function edit($id) {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id) {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nomor_plat' => 'required|unique:kendaraan,nomor_plat,' . $kendaraan->id,
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tipe' => 'required|in:Motor,Mobil'
        ]);

        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui');
    }

    public function destroy($id) {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus');
    }
}

