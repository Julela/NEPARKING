@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">🏍️ Tambah Kendaraan</h2>

            </div>
        </div>
    </div>
</div>
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mt-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kendaraan.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nomor Plat</label>
            <input type="text" name="nomor_plat" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Contoh: B 1234 ABC" required>
            @error('nomor_plat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Merk</label>
            <input type="text" name="merk" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Contoh: Honda, Yamaha" required>
            @error('merk') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Model</label>
            <input type="text" name="model" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Contoh: Vario 150, Supra X" required>
            @error('model') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Warna</label>
            <input type="text" name="warna" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Contoh: Merah, Hitam" required>
            @error('warna') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Tipe Kendaraan</label>
            <select name="tipe" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="">Pilih Tipe</option>
                <option value="Motor">Motor</option>
                <option value="Mobil">Mobil</option>
            </select>
            @error('tipe') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
