{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <div class="font-[sans-serif] bg-white flex items-center justify-center md:h-screen p-4">
        <div class="shadow-[0_2px_16px_-3px_rgba(6,81,237,0.3)] max-w-6xl max-md:max-w-lg rounded-md p-6">
            <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg" alt="logo"
                    class='w-36 md:mb-4 mb-12' />
            </a>

            <div class="grid md:grid-cols-2 items-center gap-8">
                <div class="max-md:order-1">
                    <img src="https://readymadeui.com/signin-image.webp" class="w-full aspect-[12/11] object-contain"
                        alt="login-image" />
                </div>

                <form class="md:max-w-md w-full mx-auto" method="POST" action="/register">
                    @csrf
                    <div class="mb-12">
                        <h3 class="text-4xl font-bold text-blue-600">Sign up</h3>
                    </div>

                    <div>
                        <div class="relative flex items-center">
                            <input name="email" type="text" required
                                class="w-full text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Masukan email" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                                <defs>
                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                        <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                    <path fill="none" stroke-miterlimit="10" stroke-width="40"
                                        d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                        data-original="#000000"></path>
                                    <path
                                        d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z"
                                        data-original="#000000"></path>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="relative flex items-center">
                            <input name="name" type="text" required
                                class="w-full text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Masukan nama" />
                        </div>
                    </div>
                    

                    <div class="mt-8">
                        <div class="relative flex items-center">
                            <input name="password" type="password" required
                                class="w-full text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Masukan password" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                                <path
                                    d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                    data-original="#000000"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="relative flex items-center">
                            <input name="password_confirmation" type="password" id="password_confirmation" required
                                class="w-full text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none"
                                placeholder="Masukan konfirmasi password" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                                <path
                                    d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                    data-original="#000000"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="button"
                            class="w-full flex items-center justify-center gap-2 shadow-xl py-2.5 px-4 text-sm font-semibold tracking-wide rounded-md text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none">
                            <i class="fab fa-google text-blue-600"></i>
                            Sign in dengan Google
                        </button>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
                        <div>
                            <a href="jajvascript:void(0);" class="text-blue-600 font-semibold text-sm hover:underline">
                                Lupa Password?
                            </a>
                        </div>
                    </div>

                    <div class="mt-12">
                        <button type="submit" id="register-button" value="Sign Up"
                            class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Sign up
                        </button>

                        <p class="text-gray-800 text-sm text-center mt-6">Sudah punya akun? <a href="/login"
                                class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Login
                                disini</a></p>
                    </div>
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        @if(session('error'))
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "{{ session('error') }}",
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        @endif
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>
