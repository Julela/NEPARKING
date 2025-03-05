<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ $title }}</title> --}}
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('/myhr/images/logo.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('/myhr/images/logo.png') }}" />
    <!-- Font -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/fonts.css') }}" />
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/myhr/fonts/icons-alipay.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.css') }}"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <script src="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.js') }}"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <link rel="stylesheet" type="text/css" href="{{ url('clock/dist/bootstrap-clockpicker.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .select2-container .select2-selection--single {
            height: 45px;
            line-height: 45px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 45px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 45px;
        }

        .select2-results__option {
            line-height: 45px;
        }

        .select2-selection__choice {
            line-height: 45px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

    @stack('style')
</head>

<body>
    <div class="preload preload-container">
        <div class="preload-logo"></div>
    </div>

    @if (Request::is('dashboard*'))
        <div class="app-header">
            <div class="tf-container">

                <div class="tf-topbar d-flex justify-content-between align-items-center">
                    <a class="user-info d-flex justify-content-between align-items-center"
                        href="{{ url('/my-profile') }}">
                        @if (auth()->user()->foto_karyawan == null)
                            <img src="{{ url('assets/img/foto_default.jpg') }}" alt="image">
                        @else
                            <img src="{{ url('/storage/' . auth()->user()->foto_karyawan) }}" alt="image">
                        @endif

                        <div class="content">
                            <h4 class="white_color">{{ auth()->user()->name }}</h4>
                            <p class="white_color fw_4">{{ auth()->user()->Jabatan->nama_jabatan }}</p>
                        </div>
                    </a>
                    <div class="d-flex align-items-center gap-4">
                        <a href="javascript:void(0);" id="btn-popup-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                fill="none">
                                <path
                                    d="M7.25687 5.89462C8.06884 5.35208 9.02346 5.0625 10 5.0625C11.3095 5.0625 12.5654 5.5827 13.4913 6.50866C14.4173 7.43462 14.9375 8.6905 14.9375 10C14.9375 10.9765 14.6479 11.9312 14.1054 12.7431C13.5628 13.5551 12.7917 14.188 11.8895 14.5617C10.9873 14.9354 9.99452 15.0331 9.03674 14.8426C8.07896 14.6521 7.19918 14.1819 6.50866 13.4913C5.81814 12.8008 5.34789 11.921 5.15737 10.9633C4.96686 10.0055 5.06464 9.01271 5.43835 8.1105C5.81205 7.20829 6.44491 6.43716 7.25687 5.89462ZM8.29857 12.5464C8.80219 12.8829 9.3943 13.0625 10 13.0625C10.8122 13.0625 11.5912 12.7398 12.1655 12.1655C12.7398 11.5912 13.0625 10.8122 13.0625 10C13.0625 9.3943 12.8829 8.80219 12.5464 8.29857C12.2099 7.79494 11.7316 7.40241 11.172 7.17062C10.6124 6.93883 9.99661 6.87818 9.40254 6.99635C8.80847 7.11451 8.26279 7.40619 7.83449 7.83449C7.40619 8.26279 7.11451 8.80847 6.99635 9.40254C6.87818 9.99661 6.93883 10.6124 7.17062 11.172C7.40241 11.7316 7.79494 12.2099 8.29857 12.5464ZM24.7431 14.1054C23.9312 14.6479 22.9765 14.9375 22 14.9375C20.6905 14.9375 19.4346 14.4173 18.5087 13.4913C17.5827 12.5654 17.0625 11.3095 17.0625 10C17.0625 9.02346 17.3521 8.06884 17.8946 7.25687C18.4372 6.44491 19.2083 5.81205 20.1105 5.43835C21.0127 5.06464 22.0055 4.96686 22.9633 5.15737C23.921 5.34789 24.8008 5.81814 25.4913 6.50866C26.1819 7.19918 26.6521 8.07896 26.8426 9.03674C27.0331 9.99452 26.9354 10.9873 26.5617 11.8895C26.1879 12.7917 25.5551 13.5628 24.7431 14.1054ZM23.7014 7.45363C23.1978 7.11712 22.6057 6.9375 22 6.9375C21.1878 6.9375 20.4088 7.26016 19.8345 7.83449C19.2602 8.40882 18.9375 9.18778 18.9375 10C18.9375 10.6057 19.1171 11.1978 19.4536 11.7014C19.7901 12.2051 20.2684 12.5976 20.828 12.8294C21.3876 13.0612 22.0034 13.1218 22.5975 13.0037C23.1915 12.8855 23.7372 12.5938 24.1655 12.1655C24.5938 11.7372 24.8855 11.1915 25.0037 10.5975C25.1218 10.0034 25.0612 9.38763 24.8294 8.82803C24.5976 8.26844 24.2051 7.79014 23.7014 7.45363ZM7.25687 17.8946C8.06884 17.3521 9.02346 17.0625 10 17.0625C11.3095 17.0625 12.5654 17.5827 13.4913 18.5087C14.4173 19.4346 14.9375 20.6905 14.9375 22C14.9375 22.9765 14.6479 23.9312 14.1054 24.7431C13.5628 25.5551 12.7917 26.1879 11.8895 26.5617C10.9873 26.9354 9.99452 27.0331 9.03674 26.8426C8.07896 26.6521 7.19918 26.1819 6.50866 25.4913C5.81814 24.8008 5.34789 23.921 5.15737 22.9633C4.96686 22.0055 5.06464 21.0127 5.43835 20.1105C5.81205 19.2083 6.44491 18.4372 7.25687 17.8946ZM8.29857 24.5464C8.80219 24.8829 9.3943 25.0625 10 25.0625C10.8122 25.0625 11.5912 24.7398 12.1655 24.1655C12.7398 23.5912 13.0625 22.8122 13.0625 22C13.0625 21.3943 12.8829 20.8022 12.5464 20.2986C12.2099 19.7949 11.7316 19.4024 11.172 19.1706C10.6124 18.9388 9.99661 18.8782 9.40254 18.9963C8.80847 19.1145 8.26279 19.4062 7.83449 19.8345C7.40619 20.2628 7.11451 20.8085 6.99635 21.4025C6.87818 21.9966 6.93883 22.6124 7.17062 23.172C7.40241 23.7316 7.79494 24.2099 8.29857 24.5464ZM19.2569 17.8946C20.0688 17.3521 21.0235 17.0625 22 17.0625C23.3095 17.0625 24.5654 17.5827 25.4913 18.5087C26.4173 19.4346 26.9375 20.6905 26.9375 22C26.9375 22.9765 26.6479 23.9312 26.1054 24.7431C25.5628 25.5551 24.7917 26.1879 23.8895 26.5617C22.9873 26.9354 21.9945 27.0331 21.0367 26.8426C20.079 26.6521 19.1992 26.1819 18.5087 25.4913C17.8181 24.8008 17.3479 23.921 17.1574 22.9633C16.9669 22.0055 17.0646 21.0127 17.4383 20.1105C17.8121 19.2083 18.4449 18.4372 19.2569 17.8946ZM20.2986 24.5464C20.8022 24.8829 21.3943 25.0625 22 25.0625C22.8122 25.0625 23.5912 24.7398 24.1655 24.1655C24.7398 23.5912 25.0625 22.8122 25.0625 22C25.0625 21.3943 24.8829 20.8022 24.5464 20.2986C24.2099 19.7949 23.7316 19.4024 23.172 19.1706C22.6124 18.9388 21.9966 18.8782 21.4025 18.9963C20.8085 19.1145 20.2628 19.4062 19.8345 19.8345C19.4062 20.2628 19.1145 20.8085 18.9963 21.4025C18.8782 21.9966 18.9388 22.6124 19.1706 23.172C19.4024 23.7316 19.7949 24.2099 20.2986 24.5464Z"
                                    fill="white" stroke="white" stroke-width="0.125" />
                            </svg>
                        </a>
                        <a href="{{ url('/notifications') }}" class="icon-notification1">
                            @if (auth()->user()->notifications()->whereNull('read_at')->count() > 0)
                                <span>{{ auth()->user()->notifications()->whereNull('read_at')->count() }}</span>
                            @endif
                        </a>
                    </div>
                </div>


            </div>
        </div>
    @else
        <div class="app-header st1">
            <div class="tf-container">
                <div class="tf-topbar d-flex justify-content-center align-items-center">
                    <a href="#" class="back-btn">
                        <!-- <i class="icon-left white_color"></i> -->
                        <img src="{{ asset('img/smkn1.png') }}" style="width: 25%; margin-top:35px;" alt="">
                    </a>
                    {{-- <h3 class="white_color">{{ $title }}</h3> --}}
                </div>

                @if (Auth::check())
                    <div class="tf-topbar d-flex justify-content-between align-items-center">
                        <a class="user-info d-flex justify-content-between align-items-center"></a>
                        <div class="d-flex align-items-center gap-4">
                            <a href="javascript:void(0);" id="btn-popup-left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    viewBox="0 0 32 32" fill="none">
                                    <path
                                        d="M7.25687 5.89462C8.06884 5.35208 9.02346 5.0625 10 5.0625C11.3095 5.0625 12.5654 5.5827 13.4913 6.50866C14.4173 7.43462 14.9375 8.6905 14.9375 10C14.9375 10.9765 14.6479 11.9312 14.1054 12.7431C13.5628 13.5551 12.7917 14.188 11.8895 14.5617C10.9873 14.9354 9.99452 15.0331 9.03674 14.8426C8.07896 14.6521 7.19918 14.1819 6.50866 13.4913C5.81814 12.8008 5.34789 11.921 5.15737 10.9633C4.96686 10.0055 5.06464 9.01271 5.43835 8.1105C5.81205 7.20829 6.44491 6.43716 7.25687 5.89462ZM8.29857 12.5464C8.80219 12.8829 9.3943 13.0625 10 13.0625C10.8122 13.0625 11.5912 12.7398 12.1655 12.1655C12.7398 11.5912 13.0625 10.8122 13.0625 10C13.0625 9.3943 12.8829 8.80219 12.5464 8.29857C12.2099 7.79494 11.7316 7.40241 11.172 7.17062C10.6124 6.93883 9.99661 6.87818 9.40254 6.99635C8.80847 7.11451 8.26279 7.40619 7.83449 7.83449C7.40619 8.26279 7.11451 8.80847 6.99635 9.40254C6.87818 9.99661 6.93883 10.6124 7.17062 11.172C7.40241 11.7316 7.79494 12.2099 8.29857 12.5464ZM24.7431 14.1054C23.9312 14.6479 22.9765 14.9375 22 14.9375C20.6905 14.9375 19.4346 14.4173 18.5087 13.4913C17.5827 12.5654 17.0625 11.3095 17.0625 10C17.0625 9.02346 17.3521 8.06884 17.8946 7.25687C18.4372 6.44491 19.2083 5.81205 20.1105 5.43835C21.0127 5.06464 22.0055 4.96686 22.9633 5.15737C23.921 5.34789 24.8008 5.81814 25.4913 6.50866C26.1819 7.19918 26.6521 8.07896 26.8426 9.03674C27.0331 9.99452 26.9354 10.9873 26.5617 11.8895C26.1879 12.7917 25.5551 13.5628 24.7431 14.1054ZM23.7014 7.45363C23.1978 7.11712 22.6057 6.9375 22 6.9375C21.1878 6.9375 20.4088 7.26016 19.8345 7.83449C19.2602 8.40882 18.9375 9.18778 18.9375 10C18.9375 10.6057 19.1171 11.1978 19.4536 11.7014C19.7901 12.2051 20.2684 12.5976 20.828 12.8294C21.3876 13.0612 22.0034 13.1218 22.5975 13.0037C23.1915 12.8855 23.7372 12.5938 24.1655 12.1655C24.5938 11.7372 24.8855 11.1915 25.0037 10.5975C25.1218 10.0034 25.0612 9.38763 24.8294 8.82803C24.5976 8.26844 24.2051 7.79014 23.7014 7.45363ZM7.25687 17.8946C8.06884 17.3521 9.02346 17.0625 10 17.0625C11.3095 17.0625 12.5654 17.5827 13.4913 18.5087C14.4173 19.4346 14.9375 20.6905 14.9375 22C14.9375 22.9765 14.6479 23.9312 14.1054 24.7431C13.5628 25.5551 12.7917 26.1879 11.8895 26.5617C10.9873 26.9354 9.99452 27.0331 9.03674 26.8426C8.07896 26.6521 7.19918 26.1819 6.50866 25.4913C5.81814 24.8008 5.34789 23.921 5.15737 22.9633C4.96686 22.0055 5.06464 21.0127 5.43835 20.1105C5.81205 19.2083 6.44491 18.4372 7.25687 17.8946ZM8.29857 24.5464C8.80219 24.8829 9.3943 25.0625 10 25.0625C10.8122 25.0625 11.5912 24.7398 12.1655 24.1655C12.7398 23.5912 13.0625 22.8122 13.0625 22C13.0625 21.3943 12.8829 20.8022 12.5464 20.2986C12.2099 19.7949 11.7316 19.4024 11.172 19.1706C10.6124 18.9388 9.99661 18.8782 9.40254 18.9963C8.80847 19.1145 8.26279 19.4062 7.83449 19.8345C7.40619 20.2628 7.11451 20.8085 6.99635 21.4025C6.87818 21.9966 6.93883 22.6124 7.17062 23.172C7.40241 23.7316 7.79494 24.2099 8.29857 24.5464ZM19.2569 17.8946C20.0688 17.3521 21.0235 17.0625 22 17.0625C23.3095 17.0625 24.5654 17.5827 25.4913 18.5087C26.4173 19.4346 26.9375 20.6905 26.9375 22C26.9375 22.9765 26.6479 23.9312 26.1054 24.7431C25.5628 25.5551 24.7917 26.1879 23.8895 26.5617C22.9873 26.9354 21.9945 27.0331 21.0367 26.8426C20.079 26.6521 19.1992 26.1819 18.5087 25.4913C17.8181 24.8008 17.3479 23.921 17.1574 22.9633C16.9669 22.0055 17.0646 21.0127 17.4383 20.1105C17.8121 19.2083 18.4449 18.4372 19.2569 17.8946ZM20.2986 24.5464C20.8022 24.8829 21.3943 25.0625 22 25.0625C22.8122 25.0625 23.5912 24.7398 24.1655 24.1655C24.7398 23.5912 25.0625 22.8122 25.0625 22C25.0625 21.3943 24.8829 20.8022 24.5464 20.2986C24.2099 19.7949 23.7316 19.4024 23.172 19.1706C22.6124 18.9388 21.9966 18.8782 21.4025 18.9963C20.8085 19.1145 20.2628 19.4062 19.8345 19.8345C19.4062 20.2628 19.1145 20.8085 18.9963 21.4025C18.8782 21.9966 18.9388 22.6124 19.1706 23.172C19.4024 23.7316 19.7949 24.2099 20.2986 24.5464Z"
                                        fill="white" stroke="white" stroke-width="0.125" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="tf-topbar d-flex justify-content-end align-items-center login-alert">
                        <a href="{{ route('login') }}" class="d-flex align-items-center text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 32 32" fill="none">
                                <path
                                    d="M7.25687 5.89462C8.06884 5.35208 9.02346 5.0625 10 5.0625C11.3095 5.0625 12.5654 5.5827 13.4913 6.50866C14.4173 7.43462 14.9375 8.6905 14.9375 10C14.9375 10.9765 14.6479 11.9312 14.1054 12.7431C13.5628 13.5551 12.7917 14.188 11.8895 14.5617C10.9873 14.9354 9.99452 15.0331 9.03674 14.8426C8.07896 14.6521 7.19918 14.1819 6.50866 13.4913C5.81814 12.8008 5.34789 11.921 5.15737 10.9633C4.96686 10.0055 5.06464 9.01271 5.43835 8.1105C5.81205 7.20829 6.44491 6.43716 7.25687 5.89462ZM8.29857 12.5464C8.80219 12.8829 9.3943 13.0625 10 13.0625C10.8122 13.0625 11.5912 12.7398 12.1655 12.1655C12.7398 11.5912 13.0625 10.8122 13.0625 10C13.0625 9.3943 12.8829 8.80219 12.5464 8.29857C12.2099 7.79494 11.7316 7.40241 11.172 7.17062C10.6124 6.93883 9.99661 6.87818 9.40254 6.99635C8.80847 7.11451 8.26279 7.40619 7.83449 7.83449C7.40619 8.26279 7.11451 8.80847 6.99635 9.40254C6.87818 9.99661 6.93883 10.6124 7.17062 11.172C7.40241 11.7316 7.79494 12.2099 8.29857 12.5464ZM24.7431 14.1054C23.9312 14.6479 22.9765 14.9375 22 14.9375C20.6905 14.9375 19.4346 14.4173 18.5087 13.4913C17.5827 12.5654 17.0625 11.3095 17.0625 10C17.0625 9.02346 17.3521 8.06884 17.8946 7.25687C18.4372 6.44491 19.2083 5.81205 20.1105 5.43835C21.0127 5.06464 22.0055 4.96686 22.9633 5.15737C23.921 5.34789 24.8008 5.81814 25.4913 6.50866C26.1819 7.19918 26.6521 8.07896 26.8426 9.03674C27.0331 9.99452 26.9354 10.9873 26.5617 11.8895C26.1879 12.7917 25.5551 13.5628 24.7431 14.1054ZM23.7014 7.45363C23.1978 7.11712 22.6057 6.9375 22 6.9375C21.1878 6.9375 20.4088 7.26016 19.8345 7.83449C19.2602 8.40882 18.9375 9.18778 18.9375 10C18.9375 10.6057 19.1171 11.1978 19.4536 11.7014C19.7901 12.2051 20.2684 12.5976 20.828 12.8294C21.3876 13.0612 22.0034 13.1218 22.5975 13.0037C23.1915 12.8855 23.7372 12.5938 24.1655 12.1655C24.5938 11.7372 24.8855 11.1915 25.0037 10.5975C25.1218 10.0034 25.0612 9.38763 24.8294 8.82803C24.5976 8.26844 24.2051 7.79014 23.7014 7.45363ZM7.25687 17.8946C8.06884 17.3521 9.02346 17.0625 10 17.0625C11.3095 17.0625 12.5654 17.5827 13.4913 18.5087C14.4173 19.4346 14.9375 20.6905 14.9375 22C14.9375 22.9765 14.6479 23.9312 14.1054 24.7431C13.5628 25.5551 12.7917 26.1879 11.8895 26.5617C10.9873 26.9354 9.99452 27.0331 9.03674 26.8426C8.07896 26.6521 7.19918 26.1819 6.50866 25.4913C5.81814 24.8008 5.34789 23.921 5.15737 22.9633C4.96686 22.0055 5.06464 21.0127 5.43835 20.1105C5.81205 19.2083 6.44491 18.4372 7.25687 17.8946ZM8.29857 24.5464C8.80219 24.8829 9.3943 25.0625 10 25.0625C10.8122 25.0625 11.5912 24.7398 12.1655 24.1655C12.7398 23.5912 13.0625 22.8122 13.0625 22C13.0625 21.3943 12.8829 20.8022 12.5464 20.2986C12.2099 19.7949 11.7316 19.4024 11.172 19.1706C10.6124 18.9388 9.99661 18.8782 9.40254 18.9963C8.80847 19.1145 8.26279 19.4062 7.83449 19.8345C7.40619 20.2628 7.11451 20.8085 6.99635 21.4025C6.87818 21.9966 6.93883 22.6124 7.17062 23.172C7.40241 23.7316 7.79494 24.2099 8.29857 24.5464ZM19.2569 17.8946C20.0688 17.3521 21.0235 17.0625 22 17.0625C23.3095 17.0625 24.5654 17.5827 25.4913 18.5087C26.4173 19.4346 26.9375 20.6905 26.9375 22C26.9375 22.9765 26.6479 23.9312 26.1054 24.7431C25.5628 25.5551 24.7917 26.1879 23.8895 26.5617C22.9873 26.9354 21.9945 27.0331 21.0367 26.8426C20.079 26.6521 19.1992 26.1819 18.5087 25.4913C17.8181 24.8008 17.3479 23.921 17.1574 22.9633C16.9669 22.0055 17.0646 21.0127 17.4383 20.1105C17.8121 19.2083 18.4449 18.4372 19.2569 17.8946ZM20.2986 24.5464C20.8022 24.8829 21.3943 25.0625 22 25.0625C22.8122 25.0625 23.5912 24.7398 24.1655 24.1655C24.7398 23.5912 25.0625 22.8122 25.0625 22C25.0625 21.3943 24.8829 20.8022 24.5464 20.2986C24.2099 19.7949 23.7316 19.4024 23.172 19.1706C22.6124 18.9388 21.9966 18.8782 21.4025 18.9963C20.8085 19.1145 20.2628 19.4062 19.8345 19.8345C19.4062 20.2628 19.1145 20.8085 18.9963 21.4025C18.8782 21.9966 18.9388 22.6124 19.1706 23.172C19.4024 23.7316 19.7949 24.2099 20.2986 24.5464Z"
                                    fill="white" stroke="white" stroke-width="0.125" />
                            </svg>
                        </a>
                    </div>
                @endif


            </div>

        </div>
        </div>
    @endif

    @yield('container')

    <div class="bottom-navigation-bar">
        <div class="tf-container">

            <!-- JULE -->
            @if (Auth::check())
                <ul class="tf-navigation-bar">
                    <li class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a
                            class="fw_6 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/') }}"><i
                                class="{{ Request::is('dashboard*') ? 'icon-home2' : 'icon-home' }}"></i> Home</a>
                    </li>
                    <li class="{{ Request::is('history*') ? 'active' : '' }}"><a
                            class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/history') }}"><i class="icon-history"></i> History</a> </li>
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/scan') }}"><i class="icon-scan-qr-code"></i> </a> </li>

                    <li class="{{ Request::is('my-notifikasi*') ? 'active' : '' }}">
                        <a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/my-notifikasi') }}">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <!-- Lingkaran Notifikasi -->
                                <circle cx="12" cy="12" r="9.5"
                                    stroke="{{ Request::is('my-notifikasi*') ? '#0000FF' : '#717171' }}"
                                    stroke-width="1.5" />
                                <!-- Lonceng -->
                                <path
                                    d="M15 10V9C15 7 13.5 5.5 12 5.5C10.5 5.5 9 7 9 9V10C9 11.5 8 13 7 13.5V14H17V13.5C16 13 15 11.5 15 10Z"
                                    stroke="{{ Request::is('my-notifikasi*') ? '#0000FF' : '#717171' }}"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <!-- Garis Notifikasi -->
                                <path d="M10 17H14"
                                    stroke="{{ Request::is('my-notifikasi*') ? '#0000FF' : '#717171' }}"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <span>Notifikasi</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('my-profile*') ? 'active' : '' }}"><a
                            class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/my-profile') }}"><i class="icon-user-outline"></i> Profile</a> </li>
                </ul>
            @else
                <ul class="tf-navigation-bar">
                    <li class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a
                            class="fw_6 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/') }}"><i
                                class="{{ Request::is('dashboard*') ? 'icon-home2' : 'icon-home' }}"></i> Home</a>
                    </li>
                    <li class="{{ Request::is('my-absen*') ? 'active' : '' }}"><a
                            class="fw_4 d-flex justify-content-center align-items-center flex-column login-alert"
                            href="{{ route('login') }}"><i class="icon-history"></i> History</a> </li>
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column login-alert"
                            href="{{ route('login') }}"><i class="icon-scan-qr-code"></i> </a> </li>
                    <li class="{{ Request::is('my-notifikasi*') ? 'active' : '' }}">
                        <a class="fw_4 d-flex justify-content-center align-items-center flex-column login-alert"
                            href="{{ url('/my-notifikasi') }}">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <!-- Lingkaran Notifikasi -->
                                <circle cx="12" cy="12" r="9.5"
                                    stroke="{{ Request::is('my-notifikasi*') ? '#0000FF' : '#717171' }}"
                                    stroke-width="1.5" />
                                <!-- Lonceng -->
                                <path
                                    d="M15 10V9C15 7 13.5 5.5 12 5.5C10.5 5.5 9 7 9 9V10C9 11.5 8 13 7 13.5V14H17V13.5C16 13 15 11.5 15 10Z"
                                    stroke="{{ Request::is('my-notifikasi*') ? '#0000FF' : '#717171' }}"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <!-- Garis Notifikasi -->
                                <path d="M10 17H14"
                                    stroke="{{ Request::is('my-notifikasi*') ? '#0000FF' : '#717171' }}"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <span>Notifikasi</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('my-profile*') ? 'active' : '' }}"><a
                            class="fw_4 d-flex justify-content-center align-items-center flex-column login-alert"
                            href="{{ route('login') }}"><i class="icon-user-outline"></i> Profile</a> </li>
                </ul>
            @endif

            <!-- JULE -->
        </div>
    </div>


    <div class="tf-panel left">
        <div class="panel_overlay"></div>
        <div class="panel-box panel-left panel-sidebar">
            <div class="header-sidebar bg_white_color is-fixed">
                <div class="tf-container">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url('/') }}" class="sidebar-logo" style="margin-left: -15px;">
                            <img src="{{ asset('img/smkn1.png') }}" style="width: 20%;" alt="logo" class="m-3">
                            <h5>Neparking</h5>
                        </a>
                        <a href="javascript:void(0);" class="clear-panel"> <i class="icon-close1"></i> </a>
                    </div>
                </div>
            </div><br>
            <div class="panel-body">
                <div class="tf-container">
                    <div class="box-content">

                        <ul class="box-nav">
                            <li class="nav-title">MENU</li>
                            <li>
                                <a href="{{ url('/dashboard') }}" class="nav-link">
                                    <i class="fas fa-home"
                                        style="{{ Request::is('dashboard*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('dashboard*') ? 'color: blue' : '' }}">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/my-profile') }}" class="nav-link">
                                    <i class="fas fa-user"
                                        style="{{ Request::is('my-profile*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('my-profile*') ? 'color: blue' : '' }}">
                                        Profile</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ url('/jadwal') }}" class="nav-link">
                                    <i class="fas fa-chalkboard-teacher"
                                        style="{{ Request::is('jadwal*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('jadwal*') ? 'color: blue' : '' }}">Jadwal
                                        Pelajaran</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="{{ url('/parkir') }}" class="nav-link">
                                    <i class="fas fa-parking"
                                        style="{{ Request::is('parkir*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('parkir*') ? 'color: blue' : '' }}">Parkir</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ url('/cuti') }}" class="nav-link">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                            stroke="{{ Request::is('cuti*') ? 'blue' : 'black' }}"
                                            stroke-width="2" />
                                        <path d="M9 12H15" stroke="{{ Request::is('cuti*') ? 'blue' : 'black' }}"
                                            stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    <span style="{{ Request::is('cuti*') ? 'color: blue' : '' }}">Izin / Sakit</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="{{ url('/kendaraan') }}" class="nav-link">
                                    <i class="fas fa-motorcycle"
                                        style="{{ Request::is('kendaraan*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span
                                        style="{{ Request::is('kendaraan*') ? 'color: blue' : '' }}">Kendaraan</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ url('/absen') }}" class="nav-link">
                                    <i class="fa fa-camera"
                                        style="{{ Request::is('absen*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('absen*') ? 'color: blue' : '' }}">Absensi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/request-location') }}" class="nav-link">
                                    <i class="fa fa-holly-berry"
                                        style="{{ Request::is('request-location*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span style="{{ Request::is('request-location*') ? 'color: blue' : '' }}">Request
                                        Location</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/pengajuan-absensi') }}" class="nav-link">
                                    <i class="fas fa-envelope-open-text"
                                        style="{{ Request::is('pengajuan-absensi*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span
                                        style="{{ Request::is('pengajuan-absensi*') ? 'color: blue' : '' }}">Pengajuan
                                        Absensi</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="{{ url('/my-notifikasi') }}" class="nav-link">
                                    <i class="fas fa-bell"
                                        style="{{ Request::is('my-notifikasi*') ? 'color: blue' : 'color: black' }}"></i>
                                    <span
                                        style="{{ Request::is('my-notifikasi*') ? 'color: blue' : '' }}">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="/logout" style="display: flex">
                                    @csrf
                                    <button id="logout"
                                        class="flex justify-center gap-3 rounded-md bg-red-600 py-2 px-3 font-semibold hover:bg-red-500 focus:ring-2 focus:ring-red-400"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        style="height: 40px;">
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="h-3 w-3">
                                            <path fill-rule="evenodd"
                                                d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                                clip-rule="evenodd"></path>
                                        </svg> -->
                                        <i class="fa-solid fa-arrow-right-from-bracket" style="color: #6610f2;"></i>
                                        <span style="color: #6610f2;">Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/clock/dist/bootstrap-clockpicker.min.js') }}"></script>
    <script>
        config = {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        }

        flatpickr("input[type=datetime-local]", config)
        flatpickr("input[type=datetime]", {})

        $(function() {

            $('#tablePayroll').DataTable({
                "responsive": true,
                "paging": false,
                "info": false,
                "scrollCollapse": true,
                "autoWidth": false,
                'searching': false
            });
            $("#tableprint").DataTable({
                "responsive": true,
                "autoWidth": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: 'flrtip'
                // "buttons": ["excel", "pdf", "print"]
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tableprint_wrapper .col-md-6:eq(0)');


        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('/push/bin/push.js') }}"></script>
    <script src="{{ url('/js/app.js') }}"></script>

    {{-- ALERT SURUH LOGIN --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".login-alert").forEach(function(element) {
                element.addEventListener("click", function(event) {
                    event.preventDefault(); // Mencegah link langsung terbuka

                    Swal.fire({
                        title: "Anda belum login!",
                        text: "Silakan login terlebih dahulu untuk mengakses halaman ini.",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                "{{ route('login') }}"; // Arahkan ke halaman login
                        }
                    });
                });
            });
        });
    </script>

    @include('sweetalert::alert')
    @stack('script')

    @if (session('email_error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email Salah!',
                text: "{{ session('email_error') }}",
            });
        </script>
    @endif

    @if (session('password_error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Password Salah!',
                text: "{{ session('password_error') }}",
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
            });
        </script>
    @endif



    @if (session('welcome'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "Selamat Datang, {{ Auth::user()->name }}.",
                text: "{{ session('welcome') }}",
            });
        </script>
    @endif


    @if (session('welcome_back'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Selamat Datang Kembali, {{ Auth::user()->name }}.',
                text: "{{ session('welcome_back') }}",
            });
        </script>
    @endif

    <script>
        function togglePassword(id) {
            let input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>

    <script>
        @if (session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if ($errors->has('email'))
            Swal.fire({
                title: "Error!",
                text: "{{ $errors->first('email') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if ($errors->has('password'))
            Swal.fire({
                title: "Error!",
                text: "{{ $errors->first('password') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

    <script>
        document.querySelector('.tf-form').addEventListener('submit', function(event) {
            let nisInput = document.getElementById('nis').value;

            if (nisInput.length !== 8) {
                event.preventDefault(); // Mencegah form dikirim jika tidak valid
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NIS harus tepat 8 karakter!',
                });
            }
        });
    </script>



</body>

</html>
