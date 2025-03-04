@extends('templates.dashboard')

@section('isi')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Manajemen Parkir</h2>

    {{-- Parking A --}}
    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
        <h3 class="text-xl font-semibold mb-3">Parkir A</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Plat Nomor</th>
                    <th class="py-2 px-4 border">Waktu Masuk</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parkingA as $key => $park)
                <tr class="text-center">
                    <td class="py-2 px-4 border">{{ $key + 1 }}</td>
                    <td class="py-2 px-4 border">{{ $park->license_plate }}</td>
                    <td class="py-2 px-4 border">{{ $park->waktu_masuk }}</td>
                    <td class="py-2 px-4 border">
                        <form action="{{ url('admin.deleteParking', ['id' => $park->id, 'type' => 'A']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-black px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Parking B --}}
    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-xl font-semibold mb-3">Parkir B</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Plat Nomor</th>
                    <th class="py-2 px-4 border">Waktu Masuk</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parkingB as $key => $park)
                <tr class="text-center">
                    <td class="py-2 px-4 border">{{ $key + 1 }}</td>
                    <td class="py-2 px-4 border">{{ $park->license_plate }}</td>
                    <td class="py-2 px-4 border">{{ $park->wakti_masuk }}</td>
                    <td class="py-2 px-4 border">
                        <form action="{{ url('admin.deleteParking', ['id' => $park->id, 'type' => 'B']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-black px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
