@extends('templates.dashboard')

@section('isi')
<div class="w-full px-6 py-4">
    <h2 class="text-3xl font-bold mb-4 text-gray-800 flex items-center">
        Data Kendaraan
    </h2>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-blue-600 text-black">
                <tr>
                    <th class="p-3 border">#</th>
                    <th class="p-3 border">Plat Nomor</th>
                    <th class="p-3 border">Merk</th>
                    <th class="p-3 border">Model</th>
                    <th class="p-3 border">Warna Kendaraan</th>
                    <th class="p-3 border">Tipe Kendaraan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $key => $vehicle)
                <tr class="border-b hover:bg-gray-100">
                    <td class="p-3 border">{{ $key + 1 }}</td>
                    <td class="p-3 border font-semibold">{{ $vehicle->nomor_plat }}</td>
                    <td class="p-3 border">{{ $vehicle->merk }}</td>
                    <td class="p-3 border">{{ $vehicle->model }}</td>
                    <td class="p-3 border text-center">
                        <span class="px-3 py-1 text-black text-sm font-medium rounded-full" style="background-color: {{ $vehicle->warna }}">
                            {{ ucfirst($vehicle->warna) }}
                        </span>
                    </td>
                    <td class="p-3 border text-center">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full 
                            {{ $vehicle->tipe == 'Motor' ? 'bg-green-500 text-black' : 'bg-purple-500 text-white' }}">
                            {{ ucfirst($vehicle->tipe) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
