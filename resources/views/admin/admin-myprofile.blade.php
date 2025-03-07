@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        {{-- <h4>{{ $title }}</h4> --}}
                    </div>
                    <div class="col-md-6 p-0">                    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- @if(auth()->user()->foto_karyawan == null)
                            <img class="profile-user-img img-fluid img-circle" src="{{ url('assets/img/foto_default.jpg') }}" alt="User profile picture">
                        @else
                            <img class="profile-user-img img-fluid img-circle" src="{{ url('storage/'.auth()->user()->foto_karyawan) }}" alt="User profile picture">
                        @endif --}}
                    </div>

                    {{-- <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3> --}}

                    {{-- <p class="text-muted text-center">{{ auth()->user()->Jabatan->nama_jabatan }}</p> --}}

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                        {{-- <b>Email</b> <a class="float-end" style="color: black">{{ auth()->user()->email }}</a> --}}
                        </li>
                        <li class="list-group-item">
                        {{-- <b>Username</b> <a class="float-end" style="color: black">{{ auth()->user()->username }}</a> --}}
                        </li>
                        <li class="list-group-item">
                        {{-- <b>Telepon</b> <a class="float-end" style="color: black">{{ auth()->user()->telepon }}</a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div> --}}
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <form method="post" action="{{ url('/my-profile/update/'.auth()->user()->id) }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="name">Username</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{ old('name', auth()->user()->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col mb-4">
                                        <label for="foto_karyawan" class="form-label">Img</label>
                                        <input class="form-control @error('foto_karyawan') is-invalid @enderror" type="file" id="foto_karyawan" name="foto_karyawan">
                                        @error('foto_karyawan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="foto_karyawan_lama" value="{{ auth()->user()->foto_karyawan }}">
                                </div>
                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="is_admin">Role</label>
                                        <input type="text" id="is_admin" value="{{ auth()->user()->is_admin }}" class="form-control" disabled>
                                    </div>
                                    <input type="hidden" name="password" value="{{ auth()->user()->password }}">
                                </div>
                                <div class="form-row">
                                </div>
                                <div class="form-row">
                                </div>
                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="alamat">Address</label>
                                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.money').mask('000,000,000,000,000', {
                    reverse: true
                });
            });
        </script>
    @endpush
@endsection
