@extends('admin.layouts.app')

@section('title', 'Detail Produk')
@section('page-heading', 'Detail Produk')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            @if($product->image)
                <img src="{{ asset($product->image) }}" class="card-img-top" style="max-height:300px;object-fit:cover;" alt="{{ $product->name }}">
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-success-soft text-success">{{ $product->category ?? 'Umum' }}</span>
                    <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">{{ $product->status }}</span>
                </div>
                <h3 class="fw-bold">{{ $product->name }}</h3>
                @if($product->price)
                    <h5 class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                @endif
                <p class="text-muted mt-3">{!! nl2br(e($product->description ?? '-')) !!}</p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
