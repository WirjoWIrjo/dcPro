@extends('layouts.app')

@section('title', $product->name)

@section('content')
{{-- Hero Section --}}
<div class="bg-dark text-white py-4 shadow-sm">
    <div class="container py-2">
        <a href="{{ url('/products') }}" class="text-white text-decoration-none small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Layanan
        </a>
    </div>
</div>

{{-- Product Detail --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Product Header --}}
            <div class="text-center mb-5">
                <div class="mb-3">
                    @if($product->category === 'Colocation')
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4">
                            <i class="bi bi-r-square text-primary" style="font-size:3rem;"></i>
                        </div>
                    @elseif($product->category === 'Managed Services')
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4">
                            <i class="bi bi-gear-wide-connected text-success" style="font-size:3rem;"></i>
                        </div>
                    @elseif($product->category === 'Network')
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-4">
                            <i class="bi bi-ethernet text-info" style="font-size:3rem;"></i>
                        </div>
                    @elseif($product->category === 'Disaster Recovery')
                        <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-4">
                            <i class="bi bi-shield-check text-danger" style="font-size:3rem;"></i>
                        </div>
                    @else
                        <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex p-4">
                            <i class="bi bi-box text-secondary" style="font-size:3rem;"></i>
                        </div>
                    @endif
                </div>
                <span class="badge bg-{{ $product->category === 'Colocation' ? 'primary' : ($product->category === 'Managed Services' ? 'success' : ($product->category === 'Network' ? 'info' : 'danger')) }} bg-opacity-10 text-{{ $product->category === 'Colocation' ? 'primary' : ($product->category === 'Managed Services' ? 'success' : ($product->category === 'Network' ? 'info' : 'danger')) }} mb-2">
                    {{ $product->category }}
                </span>
                <h1 class="fw-bold">{{ $product->name }}</h1>
                @if($product->price)
                    <p class="fs-4 text-muted">Mulai dari <span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}/bulan</span></p>
                @endif
            </div>

            {{-- Product Description --}}
            <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Detail Layanan</h4>
                <div class="fs-5 lh-lg text-secondary">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>

            {{-- Key Features --}}
            <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-check-circle me-2"></i>Yang Anda Dapatkan</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Support 24/7</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>SLA 99.999%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Real-time Monitoring</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Free Konsultasi</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="text-center p-4 bg-light rounded-4">
                <h5 class="fw-bold mb-3">Tertarik dengan layanan ini?</h5>
                <a href="{{ url('/contact') }}" class="btn btn-dark btn-lg px-5">
                    <i class="bi bi-envelope me-2"></i> Hubungi Tim Kami
                </a>
                <a href="{{ url('/products') }}" class="btn btn-outline-secondary btn-lg ms-2">
                    Lihat Layanan Lain
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
