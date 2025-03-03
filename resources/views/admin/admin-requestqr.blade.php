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
                                <div class="pe-0 b-r-light"></div>
                                <div class="email-top">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">                                                                       
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Status</button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'all']) }}">Semua</a>
                                                            <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'pending']) }}">Menunggu Persetujuan</a>
                                                            <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'approved']) }}">Disetujui</a>
                                                            <a class="dropdown-item" href="{{ route('admin.qr-requests', ['status' => 'rejected']) }}">Ditolak</a>
                                                        </div>
                                                    </div>
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
                                
                                <div class="inbox">
                                    @if($users->count() > 0)
                                        @foreach($users as $user)
                                            <div class="d-flex border-bottom py-2" id="user-request-{{ $user->id }}">
                                                <div class="d-flex-size-email">                                       
                                                    <label class="d-block mb-0">
                                                        @if(!$user->img)
                                                            <img class="me-3 rounded-circle" src="{{ url('assets/img/foto_default.jpg') }}" alt="image" style="width: 50px; height: 50px;">
                                                        @else
                                                            <img class="me-3 rounded-circle" src="{{ url('/storage/'.$user->img) }}" alt="" style="width: 50px; height: 50px;">
                                                        @endif
                                                    </label>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6>{{ $user->name }} ({{ $user->nis }})</h6>
                                                        @if($user->qr_status == 'pending')
                                                            <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                                                        @elseif($user->qr_status == 'approved')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @elseif($user->qr_status == 'rejected')
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </div>
                                                    <div class="mt-2">
                                                        <p class="mb-5"><strong>QR Code Lama:</strong> {{ $user->qr_code_old ?? 'Belum ada' }}</p>
                                                        <p><strong>QR Code Baru:</strong> {{ $user->qr_code }}</p>
                                                    </div>
                                                    
                                                    @if($user->qr_status == 'pending')
                                                        <div class="d-flex gap-2 mt-2">
                                                            <button onclick="approveRequest({{ $user->id }})" class="btn btn-sm btn-success">Setujui</button>
                                                            <button onclick="rejectRequest({{ $user->id }})" class="btn btn-sm btn-danger">Tolak</button>
                                                        </div>
                                                    @endif
                                                    
                                                    <span class="text-muted small">Permintaan pada: {{ date('d M Y H:i:s', strtotime($user->updated_at)) }}</span>
                                                </div>
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