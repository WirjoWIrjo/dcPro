@extends('layouts.app')

@section('title', $article->title)

@section('content')
{{-- Hero Section --}}
<div class="bg-info text-white py-4 shadow-sm">
    <div class="container py-2">
        <a href="{{ url('/articles') }}" class="text-white text-decoration-none small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Artikel
        </a>
    </div>
</div>

{{-- Article Content --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Article Header --}}
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $article->category }}</span>
                    <small class="text-muted">{{ $article->created_at->format('d M Y') }}</small>
                </div>
                <h1 class="fw-bold">{{ $article->title }}</h1>
                <p class="lead text-muted fst-italic">{{ $article->excerpt }}</p>
            </div>

            {{-- Article Image --}}
            @if($article->image)
                <div class="mb-4">
                    <img src="{{ asset($article->image) }}" class="w-100 rounded-4 shadow-sm" alt="{{ $article->title }}" style="max-height:450px;object-fit:cover;">
                </div>
            @endif

            {{-- Article Body --}}
            <div class="article-body fs-5 lh-lg text-secondary">
                {!! nl2br(e($article->content)) !!}
            </div>

            {{-- Back Button --}}
            <div class="mt-5 pt-4 border-top">
                <a href="{{ url('/articles') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Artikel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
