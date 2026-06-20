@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
{{-- Hero Section --}}
<div class="bg-dark text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-hdd-network me-2"></i> Layanan Kami</h1>
        <p class="lead opacity-75 mb-0">
            Solusi infrastruktur data center yang andal, aman, dan sesuai kebutuhan bisnis Anda.
        </p>
    </div>
</div>

{{-- Services Grid --}}
<div class="container py-5">
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    {{-- Icon --}}
                    <div class="card-body d-flex flex-column text-center">
                        <div class="mb-3">
                            @if($product->category === 'Colocation')
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3">
                                    <i class="bi bi-r-square text-primary fs-1"></i>
                                </div>
                            @elseif($product->category === 'Managed Services')
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3">
                                    <i class="bi bi-gear-wide-connected text-success fs-1"></i>
                                </div>
                            @elseif($product->category === 'Network')
                                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-3">
                                    <i class="bi bi-ethernet text-info fs-1"></i>
                                </div>
                            @elseif($product->category === 'Disaster Recovery')
                                <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-3">
                                    <i class="bi bi-shield-check text-danger fs-1"></i>
                                </div>
                            @else
                                <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex p-3">
                                    <i class="bi bi-box text-secondary fs-1"></i>
                                </div>
                            @endif
                        </div>

                        <span class="badge bg-{{ $product->category === 'Colocation' ? 'primary' : ($product->category === 'Managed Services' ? 'success' : ($product->category === 'Network' ? 'info' : 'danger')) }} bg-opacity-10 text-{{ $product->category === 'Colocation' ? 'primary' : ($product->category === 'Managed Services' ? 'success' : ($product->category === 'Network' ? 'info' : 'danger')) }} mb-2 mx-auto">
                            {{ $product->category }}
                        </span>

                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-secondary small flex-grow-1">{{ Str::limit($product->description, 100) }}</p>

                        @if($product->price)
                            <p class="text-muted small mb-2">Mulai dari</p>
                            <p class="fw-bold text-dark fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}<small class="text-muted fs-6">/bln</small></p>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-0 pb-3 pt-0 text-center">
                        <a href="{{ url('/products/' . $product->id) }}" class="btn btn-outline-dark btn-sm w-100">
                            Pelajari Lebih Lanjut <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-hdd-network display-1 text-muted"></i>
                <p class="mt-3">Belum ada layanan yang tersedia.</p>
            </div>
        @endforelse
    </div>

    {{-- CTA Section --}}
    <div class="mt-5 p-5 bg-primary text-white rounded-4 shadow text-center">
        <h3 class="fw-bold mb-3">Butuh Solusi Khusus?</h3>
        <p class="mb-4 opacity-75">Hubungi tim kami untuk konsultasi gratis dan penawaran yang disesuaikan dengan kebutuhan bisnis Anda.</p>
        <a href="{{ url('/contact') }}" class="btn btn-light btn-lg px-5">
            <i class="bi bi-envelope me-2"></i> Hubungi Kami
        </a>
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-8px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>
@endsection
