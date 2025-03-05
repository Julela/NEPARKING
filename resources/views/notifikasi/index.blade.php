@extends('templates.app')

@section('container')
<div class="card-section transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-2xl font-bold text-gray-200 mb-4">Notifikasi</h2>
            </div>
        </div>
    </div>
</div>

<br><br>

<div class="container">
    @if ($notifikasis->isEmpty())
        <p class="text-center">Belum ada notifikasi.</p>
    @else
        <ul class="list-group">
            @foreach ($notifikasis as $notifikasi)
                <li class="list-group-item {{ $notifikasi->is_read ? '' : 'bg-light' }}">
                    <strong>{{ $notifikasi->title }}</strong><br>
                    <small class="text-muted">{{ $notifikasi->created_at->diffForHumans() }}</small><br>
                    <p>{{ $notifikasi->message }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>


@endsection
