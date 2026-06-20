@extends('layouts.app')

@section('title', 'Data Center Home')

@section('content')
{{-- Hero Section --}}
<div class="bg-primary text-white text-center py-5 shadow-sm">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Reliable Data Center Operations</h1>
        <p class="lead opacity-75 mb-0">
            Supporting global digital infrastructure with 99.999% availability.
        </p>
    </div>
</div>

{{-- Highlights Section --}}
<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">Key Metrics</h2>
    <div class="row g-4 justify-content-center">
        @forelse($highlights as $item)
            <div class="col-sm-6 col-md-3">
                <div class="card h-100 shadow-sm border-0 text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi {{ $item->icon }} text-primary p-3 bg-primary bg-opacity-10 rounded-circle"
                               style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="fw-bold m-0">{{ $item->metric_value }}</h3>
                        <p class="text-muted small text-uppercase fw-semibold mb-0">{{ $item->metric_name }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>Data metrik sedang dalam pemeliharaan.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- Welcome Section --}}
<div class="container py-5 mb-4">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <div class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill">
                Engineering Support Team
            </div>
            <h2 class="display-6 fw-bold mb-4">Fasilitas Terpercaya &amp; Efisien</h2>
            <p class="text-secondary lh-lg">
                Selamat datang di profil operasional kami. Sebagai bagian dari tim
                <strong>Engineering Support</strong>,
                kami memastikan setiap komponen infrastruktur—mulai dari sistem daya hingga
                pendinginan—berjalan secara optimal untuk mendukung kebutuhan
                Large-Scale Data Center yang efisien.
            </p>
            <a href="{{ url('/infrastructure') }}" class="btn btn-primary mt-3 px-4 py-2">
                <i class="bi bi-arrow-right me-1"></i> Lihat Spesifikasi Teknis
            </a>
        </div>
        <div class="col-lg-6">
            <div class="position-relative">
                <img src="{{ asset('bootstrap-5.3.8-dist/images/dc-hero.png') }}"
                     class="img-fluid rounded-4 shadow-lg border"
                     alt="Data Center Facility" loading="lazy">
                <div class="position-absolute bottom-0 start-0 bg-white p-3 shadow rounded-end border-start border-primary border-4 d-none d-sm-block">
                    <span class="fw-bold">ISO 27001 Certified</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-8px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>
@endsection
