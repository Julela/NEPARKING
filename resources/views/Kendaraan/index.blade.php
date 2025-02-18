@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-2xl font-bold text-gray-200 mb-4">Kendaraan Saya</h2>

                <a href="{{ route('kendaraan.create') }}" class="bg-blue-900 hover:bg-blue-600 text-black px-4 py-2 rounded-lg mb-4 inline-block shadow-md transition">
                    ➕ Tambah Kendaraan
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="container mx-auto px-4 py-8">


    <div class="overflow-x-auto bg-gray-800 p-4 rounded-lg shadow-md">
        <table class="w-full border-collapse text-gray-200">
            <thead>
                <tr class="bg-gray-700 text-white">
                    <th class="py-3 px-4 border-b text-left">No</th>
                    <th class="py-3 px-4 border-b text-left">Nomor Plat</th>
                    <th class="py-3 px-4 border-b text-left">Merk</th>
                    <th class="py-3 px-4 border-b text-left">Model</th>
                    <th class="py-3 px-4 border-b text-left">Warna</th>
                    <th class="py-3 px-4 border-b text-left">Tipe</th>
                    <th class="py-3 px-4 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraan as $k)
                <tr class="border-b hover:bg-gray-700 transition">
                    <td class="py-3 px-4 font-bold">{{ $loop->iteration }}</td>
                    <td class="py-3 px-4 font-bold">{{ $k->nomor_plat }}</td>
                    <td class="py-3 px-4 font-bold">{{ $k->merk }}</td>
                    <td class="py-3 px-4 font-bold">{{ $k->model }}</td>
                    <td class="py-3 px-4 font-bold">{{ $k->warna }}</td>
                    <td class="py-3 px-4 font-bold">{{ $k->tipe }}</td>

                    <td class="py-3 px-4 flex space-x-4">
                        <a href="{{ route('kendaraan.edit', $k->id) }}"
                            class="btn btn-warning hover:bg-yellow-600 text-black px-4 py-2 rounded-lg shadow-md transition">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition min-w-[120px]"
                                onclick="return confirm('Yakin hapus kendaraan ini?')">
                                ❌ Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection