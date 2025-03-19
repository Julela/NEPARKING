@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-xl font-bold mb-4">Form Parkir Kendaraan</h2>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
    @if (session('error'))
        <div class="text-red-500">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="text-green-500">{{ session('success') }}</div>
    @endif
    <!-- onsubmit="return validateTime(event)" -->
    <form action="{{ route('parkir_kendaraan.store') }}" method="POST" onsubmit="return validateTime(event)">
        @csrf
        <div class="mb-4">
            <label for="qr_code" class="block text-gray-700 font-bold">Plat Nomor:</label>
            <input type="text" id="qr_code" name="qr_code" class="w-full border rounded px-3 py-2" value="{{ old('qr_code', $qr_code) }}" readonly>
        </div>
        <!--  -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold">Nama:</label>
            <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $name) }}" readonly>
        </div>
        <div class="mb-4">
            <label for="nis" class="block text-gray-700 font-bold">NIS:</label>
            <input type="text" id="nis" name="nis" class="w-full border rounded px-3 py-2" value="{{ old('nis', $nis) }}" readonly>
        </div>
        {{-- <div class="mb-4">
            <label for="class" class="block text-gray-700 font-bold">Kelas:</label>
            <input type="text" id="class" name="class" class="w-full border rounded px-3 py-2" value="{{ old('class', $class) }}" readonly>
        </div> --}}

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5 py-2 rounded shadow">Parkir</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function validateTime(event) {
    event.preventDefault(); // Mencegah form terkirim langsung

    let now = new Date();
    let cutoff = new Date();
    cutoff.setHours(8, 15, 0, 0); // Menetapkan batas waktu pukul 07:15:00

    if (now > cutoff) {
        Swal.fire({
            icon: 'error',
            title: 'Waktu Absen Ditutup!',
            text: 'Absen sudah ditutup pada pukul 07:15.',
            confirmButtonText: 'OK'
        });
        return false; // Menghentikan pengiriman form
    }

    event.target.submit(); // Kirim form jika masih dalam waktu absen
}
</script>

@endsection
