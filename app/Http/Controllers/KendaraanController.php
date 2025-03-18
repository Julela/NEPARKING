<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::where('user_id', Auth::id())->get();
        return view('kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah memiliki QR Code
        if (!$user->qr_code) {
            return redirect()->route('qr.index')->with('error', 'Anda harus membuat QR Code terlebih dahulu sebelum menambahkan kendaraan.');
        }

        // Validasi input kecuali nomor_plat karena diambil dari qr_code user
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tipe' => 'required|in:Motor,Mobil'
        ]);

        // Simpan kendaraan dengan nomor plat dari qr_code user
        Kendaraan::create([
            'user_id' => $user->id,
            'nomor_plat' => $user->qr_code, // Ambil dari QR Code user
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'tipe' => $request->tipe,
        ]);

        app(HistoryController::class)->store('Menambah kendaraan');

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }



    public function edit($id)
    {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            // 'nomor_plat' => 'required|unique:kendaraan,nomor_plat,' . $kendaraan->id,
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tipe' => 'required|in:Motor,Mobil'
        ]);

        $kendaraan->update($request->all());

        app(HistoryController::class)->store('Mengedit data kendaraan');

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $kendaraan->delete();

        app(HistoryController::class)->store('Menghapus data kendaraan');

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus');
    }
}
