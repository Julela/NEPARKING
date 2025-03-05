@extends('templates.dashboard')

@section('isi')
<div class="col-md-12 project-list">
    <div class="card">
        <div class="row">
            <div class="col-md-6 mt-2 p-0 d-flex">
                <h2 class="text-2xl font-semibold mb-4">Laporan dan Riwayat Parkir</h2>
            </div>
            <div class="col-md-6 p-0"></div>
        </div>
    </div>
</div>
<div class="container mx-auto p-6">

    {{-- Riwayat Parkir A --}}
    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
        <h4 class="text-xl font-semibold mb-3">Riwayat Parkir A</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($historyA as $history)
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <p class="font-semibold">Plat Nomor: <span class="text-blue-600">{{ $history->license_plate }}</span></p>
                <p>Waktu Masuk: <span class="text-green-600">{{ $history->waktu_masuk }}</span></p>
                <p>Waktu Keluar: <span class="text-red-600">{{ $history->waktu_keluar }}</span></p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Riwayat Parkir B --}}
    <div class="bg-white shadow-md rounded-lg p-4">
        <h4 class="text-xl font-semibold mb-3">Riwayat Parkir B</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($historyB as $history)
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <p class="font-semibold">Plat Nomor: <span class="text-blue-600">{{ $history->license_plate }}</span></p>
                <p>Waktu Masuk: <span class="text-green-600">{{ $history->waktu_masuk }}</span></p>
                <p>Waktu Keluar: <span class="text-red-600">{{ $history->waktu_keluar }}</span></p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
