@extends('templates.app')

@section('container')

<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<div class="container">
    <p>Enter your plat number</p>
    <input type="text" placeholder="No plat" id="qrText">

    <div id="imgBox" class="flex text-center justify-center">
        <canvas id="qrCanvas" class="w-fit"></canvas> <!-- Menggunakan canvas untuk menampilkan QR -->
    </div>


    <button class="btn btn-primary" onclick="generateQR()">Generate QR Code</button>
</div>

<script>
    let imgBox = document.getElementById("imgBox");
    let qrImage = document.getElementById("qrImage");
    let qrText = document.getElementById("qrText");

    // Load saved text and QR code on page load
    window.onload = function() {
        let savedText = localStorage.getItem("qrText");
        if (savedText) {
            qrText.value = savedText;
            generateQR();
        }
    }

    // function generateQR(){
    //     if (qrText.value.length > 0) {
    //         qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + qrText.value;
    //         imgBox.classList.add("show-img");
    //         localStorage.setItem("qrText", qrText.value); // Save text to localStorage
    //     } else {
    //         qrText.classList.add('error');
    //         setTimeout(()=>{
    //             qrText.classList.remove('error');
    //         },1000)
    //     }
    // }

    // function generateQR() {
    //     if (qrText.value.length > 0) {
    //         let qr = new QRious({
    //             element: document.getElementById('qrCanvas'),
    //             value: qrText.value,
    //             size: 150 // Atur ukuran QR Code
    //         });
    //         imgBox.classList.add("show-img");
    //     } else {
    //         qrText.classList.add('error');
    //         setTimeout(() => {
    //             qrText.classList.remove('error');
    //         }, 1000);
    //     }
    // }

    // function generateQR() {
    //     if (qrText.value.length > 0) {
    //         let qr = new QRious({
    //             element: document.getElementById('qrCanvas'),
    //             value: qrText.value,
    //             size: 350 // Ubah ukuran QR Code agar lebih kecil
    //         });
    //         imgBox.classList.add("show-img");
    //     } else {
    //         qrText.classList.add('error');
    //         setTimeout(() => {
    //             qrText.classList.remove('error');
    //         }, 1000);
    //     }
    // }


    window.onload = function() {
        let savedText = localStorage.getItem("qrText");
        if (savedText) {
            qrText.value = savedText;
            generateQR(); // Regenerate QR Code setelah mengisi input
        }
    };

    function generateQR() {
        if (qrText.value.length > 0) {
            let qrCanvas = document.getElementById('qrCanvas');

            let qr = new QRious({
                element: qrCanvas,
                value: qrText.value,
                size: 350 // Ukuran QR Code yang lebih kecil agar tidak terlalu besar
            });

            imgBox.classList.add("show-img");

            // Simpan teks ke localStorage agar tetap ada setelah reload
            localStorage.setItem("qrText", qrText.value);
        } else {
            qrText.classList.add('error');
            setTimeout(() => {
                qrText.classList.remove('error');
            }, 1000);
        }
    }
</script>
@endsection