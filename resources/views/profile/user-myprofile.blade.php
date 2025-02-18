@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        @if (auth()->user()->img == null)
                            <img src="{{ asset('img/profile.jpg') }}" alt="profile">
                        @else
                            <img src="{{ asset('img/' . auth()->user()->img) }}" alt="image">
                        @endif
                        <p class="fw_7 on_surface_color">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <br>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <form class="tf-form" action="{{ route('profile.update', auth()->user()->id) }}" enctype="multipart/form-data"
            method="POST">
            {{-- @method('PUT') --}}
            @csrf
            <div class="tf-container">
                <h3>Informasi Pengguna</h3>
                <br>
                <div class="group-input">
                    <label>Username</label>
                    <input type="text" class="@error('name') is-invalid @enderror" name="name"
                        value="{{ old('name', auth()->user()->name) }}" required/>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input input-group">
                    <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" />
                    <span class="input-group-text" id="basic-addon2">Foto</span>
                    @error('Img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror


                </div>
                <div class="group-input">
                    <label>Email</label>
                    <input type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email', auth()->user()->email) }}" required/>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label style="z-index: 1000">Gender</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="" disabled selected>- - Pilih - -</option>
                        <option value="1" {{ old('gender', auth()->user()->gender) == 1 ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="0" {{ old('gender', auth()->user()->gender) == 0 ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @php
                    use App\Models\Classes;
                    $classes = Classes::all();
                @endphp

                <div class="group-input">
                    <label style="z-index: 1000">Kelas</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="" disabled selected>- - Pilih - -</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ old('class_id', auth()->user()->class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="group-input" >
                    <label>Alamat</label>
                    <textarea name="address" class="@error('address') is-invalid @enderror" required>{{ old('address', auth()->user()->address) }}</textarea>
                    @error('address')
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
