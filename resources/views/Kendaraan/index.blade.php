@extends('templates.app')

@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-primary fw-bold">🏍️ Kendaraan Saya</h2>
                    @if (Auth::user()->qr_code)
                        <a href="{{ route('kendaraan.create') }}" class="btn btn-light mb-3">➕ Tambah Kendaraan</a>
                    @else
                        <a href="{{ route('qr.index') }}" class="btn btn-danger mb-3">⚠️ Buat QR Code Dulu</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container mt-5">

        <div class="list-group">
            @foreach ($kendaraan as $k)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold text-dark">{{ $k->nomor_plat }} - {{ $k->merk }} {{ $k->model }}
                        </h5>
                        <p class="mb-1 text-muted">Warna: {{ $k->warna }} | Tipe: {{ $k->tipe }}</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('kendaraan.edit', $k->id) }}" class="btn btn-primary">✏️ Edit</a>
                        <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin hapus kendaraan ini?')">❌ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection