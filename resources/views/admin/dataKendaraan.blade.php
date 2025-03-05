@extends('templates.dashboard')

@section('isi')
<div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 mt-2 p-0 d-flex">
                            <h2 class="text-3xl font-bold mb-4 text-dark">Vechile Data</h2>
                        </div>
                        <div class="col-md-6 p-0">    
                        </div>
                    </div>
                </div>
            </div>
<div class="container py-4">

    <div class="bg-white shadow rounded-lg p-4">
        @foreach ($vehicles as $key => $vehicle)
        <div class="list-group-item d-flex justify-content-between align-items-center border-bottom py-3">
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-3">{{ $key + 1 }}</span>
                <div>
                    <h5 class="mb-1 text-dark fw-bold">{{ $vehicle->nomor_plat }}</h5>
                    <p class="mb-0 text-muted">
                        {{ $vehicle->merk }} - {{ $vehicle->model }}
                    </p>
                </div>
            </div>
            <div class="text-end">
                <span class="px-3 py-1 text-dark text-sm font-medium rounded-full">
                    {{ ucfirst($vehicle->warna) }}
                </span>

                <span class="badge rounded-pill 
                    {{ $vehicle->tipe == 'Motor' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($vehicle->tipe) }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection