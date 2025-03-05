@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center text-primary fw-bold mb-4">📜 Riwayat Aktivitas</h2>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">

    @if($histories->isEmpty())
        <p class="text-center text-muted">Belum ada aktivitas yang tercatat.</p>
    @else
        <div class="list-group">
            @foreach ($histories as $history)
            <div class="list-group-item d-flex align-items-center border-start border-4 
                @if (str_contains($history->activity, 'Scan QR Code')) border-primary 
                @elseif (str_contains($history->activity, 'Parkir Masuk')) border-success 
                @elseif (str_contains($history->activity, 'Parkir Keluar')) border-danger 
                @elseif (str_contains($history->activity, 'Mengedit data kendaraan')) border-warning 
                @else border-secondary 
                @endif bg-light shadow-sm rounded mb-2 p-3">
                
                <div class="me-3 fs-3">
                    @if (str_contains($history->activity, 'Scan QR Code'))
                        📷
                    @elseif (str_contains($history->activity, 'Parkir Masuk'))
                        🚗
                    @elseif (str_contains($history->activity, 'Parkir Keluar'))
                        🚦
                    @elseif (str_contains($history->activity, 'Mengedit data kendaraan'))
                        📝
                    @else
                        🔹
                    @endif
                </div>

                <div>
                    <p class="mb-0 fw-semibold text-dark">{{ $history->activity }}</p>
                    <small class="text-muted">{{ $history->created_at->format('d M Y, H:i') }}</small>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
