@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17 10V7C17 4.24 14.76 2 12 2C9.24 2 7 4.24 7 7V10H5C4.45 10 4 10.45 4 11V20C4 20.55 4.45 21 5 21H19C19.55 21 20 20.55 20 20V11C20 10.45 19.55 10 19 10H17ZM9 7C9 5.34 10.34 4 12 4C13.66 4 15 5.34 15 7V10H9V7ZM12 17C11.17 17 10.5 16.33 10.5 15.5C10.5 14.67 11.17 14 12 14C12.83 14 13.5 14.67 13.5 15.5C13.5 16.33 12.83 17 12 17Z"
                                fill="#1E90FF" />
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-200 mb-10"> Ganti Password</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <form class="tf-form" action="{{ url('/password/update/' . auth()->user()->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="tf-container">
                <h3>Ganti Password</h3>
                <br>
                <div class="group-input">
                    <label>Username</label>
                    <input type="text" class="@error('name') is-invalid @enderror" name="name"
                        value="{{ old('name', auth()->user()->name) }}" required />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Email</label>
                    <input type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email', auth()->user()->email) }}" required />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <div class="password-wrapper">
                        <input type="password" id="password" placeholder="Password" class="@error('password') is-invalid @enderror"
                            name="password" />
                        <span class="toggle-password" onclick="togglePassword('password')">
                            👁️
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="group-input">
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" placeholder="Konfirmasi Password"
                            class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation" />
                        <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                            👁️
                        </span>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="tf-btn accent large">Save</button>
            </div>
            <br>
            <br>
            <br>
            <br>
        </form>
    </div>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.money').mask('000,000,000,000,000', {
                reverse: true
            });
            $('#gender').select2();
            $('#status_nikah').select2();
        </script>
    @endpush
@endsection
