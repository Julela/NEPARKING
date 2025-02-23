@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">📚 Jadwal Pelajaran</h2>
            </div>
        </div>
    </div>
</div><br><br>
<div class="container mx-auto px-4 py-6">
    <div class="overflow-auto">
        <table class="w-full border-collapse bg-gray-800 text-black rounded-lg shadow-md">
            <thead>
                <tr class="bg-indigo-600 text-black text-lg">
                    <th class="py-3 px-4 border text-left">No</th>
                    <th class="py-3 px-4 border text-left">Mata Pelajaran</th>
                    <th class="py-3 px-4 border text-left">Guru</th>
                    <th class="py-3 px-4 border text-left">Hari</th>
                    <th class="py-3 px-4 border text-left">Jam</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $index => $item)
                <tr class="border-b hover:bg-indigo-500 transition">
                    <td class="py-3 px-4 border">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 border font-semibold">{{ $item->mata_pelajaran }}</td>
                    <td class="py-3 px-4 border">{{ $item->guru }}</td>
                    <td class="py-3 px-4 border">{{ $item->hari }}</td>
                    <td class="py-3 px-4 border">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection