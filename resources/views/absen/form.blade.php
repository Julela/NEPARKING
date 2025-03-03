{{-- resources/views/absen/form.blade.php --}}
@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-xl font-bold mb-4">Form Kehadiran Kendaraan</h2>
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
    <form action="{{ route('absen.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="license_plate" class="block text-gray-700 font-bold">Plat Nomor:</label>
            <input type="text" id="license_plate" name="license_plate" class="w-full border rounded px-3 py-2" >
        </div>
        <!-- value="{{ old('license_plate', request('license_plate')) }}" readonly -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold">Nama:</label>
            <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="nik" class="block text-gray-700 font-bold">NIK:</label>
            <input type="text" id="nik" name="nik" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="class" class="block text-gray-700 font-bold">Kelas:</label>
            <input type="text" id="class" name="class" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Absen</button>
    </form>
</div>
<script>
function validateTime() {
    let now = new Date();
    let cutoff = new Date();
    cutoff.setHours(7, 15, 0);
    if (now > cutoff) {
        alert('Absen sudah ditutup pada pukul 07:15.');
        return false;
    }
    return true;
}
</script>
@endsection
