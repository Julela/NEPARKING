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
        $user = Auth::user();

        // Cek apakah user sudah memiliki kendaraan
        $kendaraanExist = Kendaraan::where('user_id', $user->id)->exists();
        if ($kendaraanExist) {
            return redirect()->route('kendaraan.index')->with('error', 'Anda hanya bisa menambahkan satu kendaraan.');
        }

        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah memiliki kendaraan
        $kendaraanExist = Kendaraan::where('user_id', $user->id)->exists();
        if ($kendaraanExist) {
            return redirect()->route('kendaraan.index')->with('error', 'Anda hanya bisa menambahkan satu kendaraan.');
        }

        // Cek apakah user memiliki QR Code
        if (!$user->qr_code) {
            return redirect()->route('qr.index')->with('error', 'Anda harus membuat QR Code terlebih dahulu.');
        }

        // Validasi input
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tipe' => 'required|in:Motor,Mobil'
        ]);

        // Simpan kendaraan dengan nomor plat dari qr_code user
        Kendaraan::create([
            'user_id' => $user->id,
            'nomor_plat' => $user->qr_code,
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
        $user = Auth::user();
        
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $user = Auth::user();

        // Cek apakah user memiliki QR Code
        if (!$user->qr_code) {
            return redirect()->route('qr.index')->with('error', 'Anda harus membuat QR Code terlebih dahulu.');
        }

        // Validasi input
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tipe' => 'required|in:Motor,Mobil'
        ]);

        // Update data kendaraan
        $kendaraan->update([
            'nomor_plat' => $user->qr_code,
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'tipe' => $request->tipe,
        ]);

        app(HistoryController::class)->store('Mengedit kendaraan');

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $kendaraan->delete();

        app(HistoryController::class)->store('Menghapus kendaraan');

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus');
    }
}

