@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-2xl font-bold text-gray-200 mb-4">Ajukan Izin/Cuti</h2>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cuti.store') }}" method="POST">
        @csrf

        <label for="jenis">Jenis Izin/Cuti:</label>
        <select name="jenis" id="jenis" required>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Cuti">Cuti</option>
        </select>

        <label for="tanggal_mulai">Tanggal Mulai:</label>
        <input type="date" name="tanggal_mulai" required>

        <label for="tanggal_selesai">Tanggal Selesai:</label>
        <input type="date" name="tanggal_selesai" required>

        <label for="keterangan">Keterangan (Opsional):</label>
        <textarea name="keterangan"></textarea>

        <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
</div>
@endsection
