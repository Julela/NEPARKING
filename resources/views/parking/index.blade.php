@extends('templates.app')

@section('container')

<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center mb-4 text-primary fw-bold">Daftar Kendaraan Terparkir</h2>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <!-- Pesan Notifikasi -->
    @if(session('message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari plat nomor...">
    </div>

    <!-- Tabel A -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tabel Parkir A</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parkingA as $key => $car)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="license-plate">{{ $car->license_plate }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel B -->
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tabel Parkir B</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parkingB as $key => $car)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="license-plate">{{ $car->license_plate }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.3s;
    }

    .license-plate {
        font-weight: bold;
        color: #333;
    }
</style>

<!-- JavaScript untuk Search Bar -->
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