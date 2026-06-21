@extends('layouts.app')

@section('title', 'Detail Sistem')

@section('content')
<div class="bg-primary text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-hdd-network me-2"></i> Detail Sistem</h1>
        <p class="lead opacity-75 mb-0">Detail infrastruktur: {{ $system->equipment_name }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Kategori</div>
                        <div class="col-sm-8"><span class="badge bg-primary">{{ $system->system_category }}</span></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Nama Peralatan</div>
                        <div class="col-sm-8">{{ $system->equipment_name }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Deskripsi</div>
                        <div class="col-sm-8">{{ $system->description ?? '-' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Status</div>
                        <div class="col-sm-8">
                            <span class="badge bg-{{ $system->status === 'Active' ? 'success' : ($system->status === 'Maintenance' ? 'warning' : 'secondary') }}">
                                {{ $system->status }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-4">
                    <a href="{{ url('/infrastructure') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
