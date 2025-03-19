@extends('templates.dashboard')

@section('isi')
    <div class="col-md-12 project-list">
        <div class="card">
            <div class="row text-center">
                <div class="col-md-6 mt-2 p-0 d-flex">
                    <h2 class="text-2xl font-semibold mb-6 text-center">Parking Management</h2>
                </div>
                <div class="col-md-6 p-0">
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto p-6">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Parking A --}}
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-blue-600 mb-3">Area A</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($parkingA as $park)
                    <div class="bg-blue-100 p-4 rounded-lg shadow-lg flex justify-between items-center">
                        <div>
                            <p class="text-lg font-semibold">{{ $park->user->name ?? 'Tidak Diketahui' }}</p>
                            <p class="text-lg font-semibold">{{ $park->qr_code }}</p>
                            <p class="text-black text-sm">Masuk: {{ $park->waktu_masuk }}</p>
                        </div>
                        <form action="{{ route('admin.admin.destroyParking', ['id' => $park->id, 'type' => 'A']) }}"
                            method="POST" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');">
                            @csrf
                            @method('DELETE')
                            <button
                                class="btn btn-sm btn-danger text-black px-4 py-2 rounded-full shadow-md hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>


        {{-- Parking B --}}
        <div>
            <h3 class="text-xl font-semibold text-green-600 mb-3">Area B</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($parkingB as $park)
                    <div class="bg-green-100 p-4 rounded-lg shadow-lg flex justify-between items-center">
                        <div>
                            <p class="text-lg font-semibold">{{ $park->user->name ?? 'Tidak Diketahui' }}</p>
                            <p class="text-lg font-semibold">{{ $park->qr_code }}</p>
                            <p class="text-black text-sm">Masuk: {{ $park->waktu_masuk }}</p>
                        </div>
                        <form action="{{ route('admin.admin.destroyParking', ['id' => $park->id, 'type' => 'B']) }}"
                            method="POST" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');">
                            @csrf
                            @method('DELETE')
                            <button
                                class="btn btn-sm btn-danger text-black px-4 py-2 rounded-full shadow-md hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
