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
    <form action="{{ route('absen.store') }}" method="POST">
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

        <button type="submit" class="btn btn-primary text-black px-4 py-2 rounded">Parkir</button>
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
