@extends('templates.app')

@section('container')
<div class="card-secton transfer-section">
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center text-primary fw-bold mb-4">Scan Kode QR</h2>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5 class="card-title">Arahkan kamera ke Kode QR</h5>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <div id="qr-reader" style="width: 100%; max-width: 500px;"></div>
                    </div>
                    
                    <div class="mt-3">
                        <div id="qr-reader-results"></div>
                    </div>
                    
                    <form id="qr-form" action="{{ route('scanner.process') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="qr_code" id="qr_code">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const html5QrCode = new Html5Qrcode("qr-reader");
    const qrResultContainer = document.getElementById('qr-reader-results');
    const form = document.getElementById('qr-form');
    const qrContentInput = document.getElementById('qr_code');
    
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        // Hentikan pemindaian setelah menemukan QR code
        html5QrCode.stop();
        
        // Tampilkan hasil pemindaian
        qrResultContainer.innerHTML = `
            <div class="alert alert-success">
                <strong>QR Code Terdeteksi:</strong> ${decodedText}
                <div class="mt-2">Mengalihkan ke halaman parkir kendaraan...</div>
            </div>
        `;
        
        // Set nilai input dan submit form
        qrContentInput.value = decodedText;
        
        // Tunggu sebentar untuk efek visual sebelum submit
        setTimeout(() => {
            form.submit();
        }, 1500);
    };
    
    const config = { fps: 10, qrbox: { width: 250, height: 250 } };
    
    // Mulai pemindaian
    html5QrCode.start(
        { facingMode: "environment" }, 
        config, 
        qrCodeSuccessCallback
    ).catch(err => {
        // Jika kamera gagal dimulai
        qrResultContainer.innerHTML = `
            <div class="alert alert-danger">
                <strong>Error:</strong> Gagal mengakses kamera. Pastikan Anda mengizinkan akses kamera.
            </div>
        `;
    });
});
</script>
@endsection