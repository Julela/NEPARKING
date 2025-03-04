@extends('templates.dashboard')

@section('isi')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Manajemen Pengguna</h2>
    
    <a href="#" class="bg-blue-500 text-black px-4 py-2 rounded mb-4 inline-block">Tambah Pengguna</a>
    
    <div class="bg-white p-4 rounded shadow">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="border p-2">{{ $user->id }}</td>
                    <td class="border p-2">{{ $user->name }}</td>
                    <td class="border p-2">{{ $user->email }}</td>
                    <td class="border p-2">
                        <a href="#" class="text-blue-500">Edit</a> |
                        <a href="#" class="text-red-800">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
