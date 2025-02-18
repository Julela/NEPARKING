@extends('templates.app')

@section('container')
<div class="container">
    <h2 class="text-center">Notifikasi</h2>

    @if ($notifikasis->isEmpty())
        <p class="text-center">Belum ada notifikasi.</p>
    @else
        <ul class="list-group">
            @foreach ($notifikasis as $notifikasi)
                <li class="list-group-item">
                    <strong>{{ $notifikasi->judul }}</strong><br>
                    <small class="text-muted">{{ $notifikasi->created_at->diffForHumans() }}</small><br>
                    <p>{{ $notifikasi->pesan }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
