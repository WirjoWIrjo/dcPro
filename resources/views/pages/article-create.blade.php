@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="bg-info text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-plus-circle me-2"></i> Tambah Artikel</h1>
        <p class="lead opacity-75 mb-0">Publikasikan artikel atau wawasan teknis baru.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('monitoring.storeArticle') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" required placeholder="Masukkan judul artikel">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ringkasan <span class="text-danger">*</span></label>
                            <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror"
                                      rows="3" required placeholder="Ringkasan singkat artikel">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                      rows="10" required placeholder="Isi artikel lengkap">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-info text-white">
                                <i class="bi bi-check-lg me-1"></i> Publikasikan
                            </button>
                            <a href="{{ url('/articles') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
