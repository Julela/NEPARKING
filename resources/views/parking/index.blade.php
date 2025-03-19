@extends('templates.app')

@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="text-center text-primary fw-bold">Daftar Kendaraan Terparkir</h2>
                    {{-- <a href="{{ route('izin.create') }}" class="btn btn-warning">Izin</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <!-- Pesan Notifikasi -->
        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari plat nomor...">
        </div>

        @foreach (['A' => $parkingA, 'B' => $parkingB] as $area => $parking)
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-{{ $area == 'A' ? 'primary' : 'success' }} text-white">
                    <h5 class="mb-0">Area {{ $area }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Plat Nomor</th>
                                {{-- <th>Status</th> --}}
                                <th>Aksi</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parking as $key => $car)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="license-plate">{{ $car->qr_code }}</td>
                                    {{-- <td>
                                        <span class="badge bg-{{ $car->status == 'parkir' ? 'success' : 'warning' }}">
                                            {{ ucfirst($car->status) }}
                                        </span>
                                    </td> --}}
                                    <td>
                                        @if (Auth::user()->qr_code == $car->qr_code)
                                            <button class="btn btn-danger btn-sm w-100"
                                                onclick="confirmExit('{{ route('parking.exit', ['qr_code' => $car->qr_code]) }}')">
                                                Keluar Parkir
                                            </button>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                let plate = row.querySelector('.license-plate').textContent.toUpperCase();
                row.style.display = plate.includes(filter) ? '' : 'none';
            });
        });
    </script>
@endsection