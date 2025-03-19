@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center mb-4 text-primary fw-bold">Form izin</h2>
                <a href="{{ route('parkir.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('izin.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="qr_code" class="form-label">Plat Nomor</label>
                    <input type="text" class="form-control" id="qr_code" name="qr_code" required>
                </div>
                <button type="submit" class="btn btn-warning">Izin</button>
            </form>
        </div>
    </div>
</div>
@endsection
