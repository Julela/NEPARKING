@extends('templates.dashboard')

@section('isi')
<div class="col-md-12 project-list">
    <div class="card">
        <div class="row">
            <div class="col-md-6 mt-2 p-0 d-flex">
                <h2 class="text-2xl font-semibold mb-4">Users Management</h2>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-6">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tombol Tambah Pengguna -->
    <a href="{{ route('admin.admin.createUser') }}" class="btn btn-primary mb-4">Tambah Pengguna</a>

    <div class="list-group">
        @foreach($users as $user)
        <div class="list-group-item d-flex justify-content-between align-items-center border rounded p-3 mb-2 shadow-sm">
            <div>
                <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                <p class="mb-0 text-muted">{{ $user->email }}</p>
            </div>
            <div>
                <!-- Tombol Edit -->
                <a href="{{ route('admin.admin.editUser', $user->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>

                <!-- Tombol Hapus dalam Form -->
                <form action="{{ route('admin.admin.dataUser.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
