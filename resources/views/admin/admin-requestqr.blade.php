@extends('templates.dashboard')

@section('isi')
    <div class="email-wrap">
        <div class="row">
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 mt-2 p-0 d-flex">
                            <h4>Permintaan Perubahan QR Code</h4>
                        </div>
                        <div class="col-md-6 p-0">    
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="email-right-aside">
                    <div class="card email-body">
                        <div class="email-profile">
                            <div>
                                <div class="email-top">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between align-items-center">
                                            <h5 class="m-0">Daftar Permintaan</h5>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown">
                                                    Filter Status
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'all']) }}">Semua</a>
                                                    <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'pending']) }}">Menunggu Persetujuan</a>
                                                    <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'approved']) }}">Disetujui</a>
                                                    <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'rejected']) }}">Ditolak</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(session('message'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <div class="inbox mt-3">
                                    @if($users->count() > 0)
                                        @foreach($users as $user)
                                            <div class="border rounded p-3 mb-3 shadow-sm" id="user-request-{{ $user->id }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        @php
                                                            $profileImage = $user->img ? asset('img/'.$user->img) : asset('assets/img/foto_default.jpg');
                                                        @endphp
                                                        <img class="rounded-circle" src="{{ $profileImage }}" alt="image" width="50" height="50">
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">{{ $user->name }} ({{ $user->nis }})</h6>
                                                        <small class="text-muted d-block px-10">
                                                            Permintaan pada: {{ \Carbon\Carbon::parse($user->updated_at)->format('d M Y H:i:s') }}
                                                        </small>
                                                    </div>

                                                    <div>
                                                        @if($user->qr_status == 'pending')
                                                            <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                                                        @elseif($user->qr_status == 'approved')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @elseif($user->qr_status == 'rejected')
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mt-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><strong>QR Code Lama:</strong></p>
                                                            @if($user->qr_code_old)
                                                                <h4 class="mb-0">{{ $user->qr_code_old }}</h4>
                                                            @else
                                                                <p class="text-muted">Belum ada</p>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <p><strong>QR Code Perubahan:</strong></p>
                                                            <h4 class="mb-0">{{ $user->qr_code }}</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($user->qr_status == 'pending')
                                                    <div class="mt-3 d-flex gap-2">
                                                        <button onclick="approveRequest({{ $user->id }})" class="btn btn-sm btn-success">Setujui</button>
                                                        <button onclick="rejectRequest({{ $user->id }})" class="btn btn-sm btn-danger">Tolak</button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach

                                        <div class="d-flex justify-content-end me-4 mt-4">
                                            {{ $users->links() }}
                                        </div>
                                    @else
                                        <div class="alert alert-info mt-3">
                                            Tidak ada permintaan perubahan QR Code {{ request('status') == 'pending' ? 'menunggu persetujuan' : (request('status') == 'approved' ? 'disetujui' : (request('status') == 'rejected' ? 'ditolak' : '')) }}.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="approve-form" action="" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="reject-form" action="" method="POST" style="display: none;">
        @csrf
    </form>

@endsection
