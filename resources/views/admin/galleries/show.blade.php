@extends('admin.layouts.app')

@section('title', 'Detail Galeri')
@section('page-heading', 'Detail Galeri')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <img src="{{ asset($gallery->image) }}" class="card-img-top" style="max-height:400px;object-fit:cover;" alt="{{ $gallery->title }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="fw-bold">{{ $gallery->title }}</h3>
                    @if($gallery->category)
                        <span class="badge bg-warning-soft text-warning">{{ $gallery->category }}</span>
                    @endif
                </div>
                <p class="text-muted">{{ $gallery->caption ?? '-' }}</p>
                <small class="text-muted">Ditambahkan: {{ $gallery->created_at->format('d M Y H:i') }}</small>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
