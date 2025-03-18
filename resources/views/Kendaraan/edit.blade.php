@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-2xl font-bold text-gray-200 mb-4">🏍️ Edit Kendaraan</h2>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    
    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nomor_plat" class="form-label">Nomor Plat</label>
            <input type="text" id="qr_code" name="qr_code" class="w-full border rounded px-3 py-2" value="{{ old('qr_code', $qr_code) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" value="{{ old('merk', $kendaraan->merk) }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $kendaraan->model) }}" required>
        </div>

        <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" class="form-control" id="warna" name="warna" value="{{ old('warna', $kendaraan->warna) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Kendaraan</label>
            <select class="form-control" id="tipe" name="tipe" required>
                <option value="Motor" {{ $kendaraan->tipe == 'Motor' ? 'selected' : '' }}>Motor</option>
                <option value="Mobil" {{ $kendaraan->tipe == 'Mobil' ? 'selected' : '' }}>Mobil</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
