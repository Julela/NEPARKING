<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    @include('auth.login')
    @include('auth.register')

    <script>
        document.getElementById('register-button').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah form submit dulu
    
        console.log("Validasi dijalankan"); // Tambahkan ini untuk memastikan script dijalankan
    
        let password = document.querySelector('input[name="password"]').value;
        let confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
        let form = document.querySelector('form');
    
        if (password.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Password Terlalu Pendek',
                text: 'Password harus memiliki minimal 8 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        } else if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Konfirmasi Password Salah',
                text: 'Password dan Konfirmasi Password tidak cocok!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        } else {
            form.submit(); // Jika semua validasi lolos, submit form
        }
    });
    </script>
    
   

</body>






{{-- ICON MATA UNTUK FORM REGIS --}}
<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = passwordInput.nextElementSibling;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.innerHTML = `<path d="M64 24C22.127 24 1.367 60.504.504 62.057a4 4 0 0 0 0 3.887C1.367 67.496 22.127 104 64 104s62.633-36.504 63.496-38.057a4 4 0 0 0 0-3.887C126.633 60.504 105.873 24 64 24zM8.707 64.006C13.465 56.795 32.146 32 64 32c31.955 0 50.553 24.775 55.293 31.994C114.535 71.205 95.854 96 64 96 32.045 96 13.447 71.225 8.707 64.006zM64 88c13.234 0 24-10.766 24-24S77.234 40 64 40 40 50.766 40 64s10.766 24 24 24zm0-40c8.822 0 16 7.178 16 16s-7.178 16-16 16-16-7.178-16-16 7.178-16 16-16z" data-original="#000000"></path>`;
        } else {
            passwordInput.type = "password";
            eyeIcon.innerHTML = `<path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>`;
        }
    }
</script>

</html>
