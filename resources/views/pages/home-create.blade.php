@extends('layouts.app')

@section('title', 'Tambah Highlight')

@section('content')
<div class="bg-primary text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-plus-circle me-2"></i> Tambah Highlight</h1>
        <p class="lead opacity-75 mb-0">Tambahkan metrik baru ke halaman utama.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('home.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Icon (Bootstrap Icon) <span class="text-danger">*</span></label>
                            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                                   value="{{ old('icon') }}" required placeholder="Contoh: bi-shield-check, bi-lightning-charge">
                            <small class="text-muted">Gunakan format Bootstrap Icons: <code>bi-*</code></small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Metrik <span class="text-danger">*</span></label>
                            <input type="text" name="metric_name" class="form-control @error('metric_name') is-invalid @enderror"
                                   value="{{ old('metric_name') }}" required placeholder="Contoh: Uptime SLA">
                            @error('metric_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nilai Metrik <span class="text-danger">*</span></label>
                            <input type="text" name="metric_value" class="form-control @error('metric_value') is-invalid @enderror"
                                   value="{{ old('metric_value') }}" required placeholder="Contoh: 99.999%">
                            @error('metric_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
