@extends('admin.layouts.app')

@section('title', 'Detail Artikel')
@section('page-heading', 'Detail Artikel')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            @if($article->image)
                <img src="{{ asset($article->image) }}" class="card-img-top" style="max-height:300px;object-fit:cover;" alt="{{ $article->title }}">
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-primary-soft text-primary">{{ $article->category }}</span>
                    <small class="text-muted">{{ $article->created_at->format('d M Y H:i') }}</small>
                </div>
                <h3 class="fw-bold">{{ $article->title }}</h3>
                <p class="text-muted fst-italic">{{ $article->excerpt }}</p>
                <hr>
                <div class="article-content">{!! nl2br(e($article->content)) !!}</div>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
