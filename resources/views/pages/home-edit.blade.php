@extends('layouts.app')

@section('title', 'Edit Highlight')

@section('content')
<div class="bg-primary text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Highlight</h1>
        <p class="lead opacity-75 mb-0">Perbarui data metrik: {{ $highlight->metric_name }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('home.update', $highlight->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Icon (Bootstrap Icon) <span class="text-danger">*</span></label>
                            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                                   value="{{ old('icon', $highlight->icon) }}" required>
                            <small class="text-muted">Gunakan format Bootstrap Icons: <code>bi-*</code></small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Metrik <span class="text-danger">*</span></label>
                            <input type="text" name="metric_name" class="form-control @error('metric_name') is-invalid @enderror"
                                   value="{{ old('metric_name', $highlight->metric_name) }}" required>
                            @error('metric_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nilai Metrik <span class="text-danger">*</span></label>
                            <input type="text" name="metric_value" class="form-control @error('metric_value') is-invalid @enderror"
                                   value="{{ old('metric_value', $highlight->metric_value) }}" required>
                            @error('metric_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Perbarui
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
