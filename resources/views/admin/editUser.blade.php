@extends('templates.dashboard')

@section('isi')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Edit Pengguna</h2>

    <form action="{{ route('admin.admin.dataUser.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.admin.dataUser') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
