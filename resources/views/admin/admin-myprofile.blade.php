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
                        @if (auth()->user()->img == null)
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/profile.jpg') }}"
                                alt="User profile picture">
                        @else
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('img/' . auth()->user()->img) }}" alt="User profile picture">
                        @endif
                    </div>

                    <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-end" style="color: black">{{ auth()->user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Role</b> <a class="float-end" style="color: black">{{ auth()->user()->getRoleNames()->first() }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Address</b> <a class="float-end" style="color: black">{{ auth()->user()->address }}</a>
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
                            <form method="post" action="{{ url('/admin/my-profile/update/' . auth()->user()->id) }}"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="name">Username</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" autofocus
                                            value="{{ old('name', auth()->user()->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col mb-4">
                                        <label for="img" class="form-label">Img</label>
                                        <input class="form-control @error('img') is-invalid @enderror"
                                            type="file" id="img" name="img">
                                        @error('img')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <input type="hidden" name="img" value="{{ auth()->user()->img }}">
                                </div>

                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender"
                                            class="form-control @error('gender') is-invalid @enderror">
                                            <option value="1" {{ auth()->user()->gender == 1 ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="0" {{ auth()->user()->gender == 0 ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="role">Role</label>
                                        <input type="text" id="role"
                                            value="{{ auth()->user()->getRoleNames()->first() }}" class="form-control"
                                            disabled>
                                    </div>
                                    <input type="hidden" name="password" value="{{ auth()->user()->password }}">
                                </div>

                                <div class="form-row">
                                    <div class="col mb-4">
                                        <label for="alamat">Address</label>
                                        <textarea name="address" id="alamat" class="form-control @error('address') is-invalid @enderror">{{ old('address', auth()->user()->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
            $(document).ready(function() {
                $('.money').mask('000,000,000,000,000', {
                    reverse: true
                });
            });
        </script>
    @endpush
@endsection
