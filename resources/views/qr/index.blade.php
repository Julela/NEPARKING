@extends('templates.app')

@section('container')

<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

<div class="container">
    <p>Masukkan nomor plat Anda</p>
    <input type="text" placeholder="No plat" id="qrText" oninput="checkUppercase(this)">

    <div id="imgBox" class="flex text-center justify-center">
        <canvas id="qrCanvas" class="w-fit"></canvas>
    </div>

    <button class="btn btn-primary" onclick="generateQR()" id="generateBtn">Generate QR Code</button>
</div>

<script>
    let imgBox = document.getElementById("imgBox");
    let qrText = document.getElementById("qrText");
    let generateBtn = document.getElementById("generateBtn");
    let userData = @json(auth()->user());
    
    // Menampilkan QR yang sudah ada jika user sudah memiliki QR code
    document.addEventListener('DOMContentLoaded', function() {
        if (userData.qr_code) {
            qrText.value = userData.qr_code;
            let qrCanvas = document.getElementById('qrCanvas');
            let qr = new QRious({
                element: qrCanvas,
                value: userData.qr_code,
                size: 250
            });
            imgBox.classList.add("show-img");
        }
    });

    function checkUppercase(input) {
        let value = input.value;
        if (value !== value.toUpperCase()) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Untuk mengisi plat number isi dengan huruf kapital dan angka!',
            });
            input.value = value.toUpperCase();
        }
    }

    function generateQR() {
        // Cek apakah profil belum lengkap
        if (!userData.name || !userData.email || !userData.nis || !userData.gender || !userData.classes_id || !userData.address) {
            Swal.fire({
                icon: 'warning',
                title: 'Profil Belum Lengkap!',
                text: 'Harap lengkapi profil Anda sebelum generate QR Code!',
                confirmButtonText: 'Lengkapi Profil',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/my-profile"; // Redirect ke halaman profil
                }
            });
            return;
        }

        // Cek apakah QR Code dalam status pending
        if (userData.qr_status === "pending") {
            Swal.fire({
                icon: 'info',
                title: 'Menunggu Persetujuan',
                text: 'Perubahan QR Code sedang menunggu persetujuan admin!',
            });
            return;
        }

        if (qrText.value.length === 0) {
            qrText.classList.add('error');
            setTimeout(() => {
                qrText.classList.remove('error');
            }, 1000);
            return;
        }

        // Menampilkan QR code di halaman
        let qrCanvas = document.getElementById('qrCanvas');
        let qr = new QRious({
            element: qrCanvas,
            value: qrText.value.toUpperCase(),
            size: 250
        });
        imgBox.classList.add("show-img");

        // Menyimpan QR code ke database
        saveQRCode(qrText.value.toUpperCase());
    }

    function saveQRCode(qrValue) {
        // AJAX request untuk menyimpan QR code
        fetch('/request-qr-update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                qr_code: qrValue
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update data user lokal
                userData.qr_code = qrValue;
                userData.qr_status = data.qr_status;
                
                let message = '';
                if (data.qr_status === 'pending') {
                    message = 'Permintaan perubahan QR Code telah dikirim ke admin.';
                } else {
                    message = 'QR Code berhasil dibuat.';
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Gagal menyimpan QR Code, silakan coba lagi.',
            });
        });
    }
</script>

@endsection