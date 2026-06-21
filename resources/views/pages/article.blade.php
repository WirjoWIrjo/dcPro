@extends('layouts.app')

@section('title', 'Artikel & Publikasi Teknis')

@section('content')
{{-- Hero Section --}}
<div class="bg-info text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-newspaper me-2"></i> Artikel & Wawasan Teknis</h1>
        <p class="lead opacity-75 mb-0">
            Update terbaru mengenai manajemen infrastruktur dan inovasi teknologi data center.
        </p>
    </div>
</div>

{{-- Articles Grid --}}
<div class="container py-5">
    <div class="row g-4">
        @forelse($articles as $post)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    @if($post->image)
                        <img src="{{ asset($post->image) }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="{{ $post->title }}">
                    @else
                        <div class="bg-light text-muted d-flex align-items-center justify-content-center" style="height:200px;">
                            <i class="bi bi-image fs-1 opacity-25"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $post->category }}</span>
                            <small class="text-muted">{{ $post->created_at->format('d M Y') }}</small>
                        </div>
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="card-text text-secondary small">{{ $post->excerpt }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pb-3">
                        <a href="{{ url('/articles/' . $post->id) }}" class="btn btn-outline-primary btn-sm w-100">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-journal-x display-1 text-muted"></i>
                <p class="mt-3">Belum ada artikel yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-8px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
    .card-title { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>
@endsection
