@extends('layouts.app')

@section('title', 'Environmental Sustainability')

@section('content')
{{-- Hero Section --}}
<div class="bg-success text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-recycle me-2"></i> Sustainability &amp; Energy Efficiency</h1>
        <p class="lead opacity-75 mb-0">
            Komitmen kami terhadap efisiensi energi melalui monitoring PUE secara real-time dan kepatuhan standar ISO 50001.
        </p>
    </div>
</div>

{{-- Metrics Grid --}}
<div class="container py-5">
    <div class="row g-4">
        @forelse($metrics as $metric)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm overflow-hidden h-100 hover-lift">
                    <div class="row g-0">
                        <div class="col-md-4 bg-success d-flex align-items-center justify-content-center text-white p-4">
                            <div class="text-center">
                                <h2 class="fw-bold mb-0">{{ $metric->pue_value }}</h2>
                                <small>Current PUE</small>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Periode: {{ $metric->period }}</h5>
                                <p class="card-text mb-1">
                                    <i class="bi bi-lightning-charge me-2 text-warning"></i>
                                    Total Consumption: <strong>{{ number_format($metric->total_consumption) }} kWh</strong>
                                </p>
                                <p class="small text-muted mb-0">
                                    Data ini diverifikasi melalui sistem monitoring EMS untuk audit energi internal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-exclamation-triangle display-4 text-muted"></i>
                <p class="mt-3 text-muted">Tidak ada data metrik tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    {{-- Professional Statement --}}
    <div class="mt-5 p-4 bg-white rounded shadow-sm border">
        <h4 class="fw-bold mb-3">Green Data Center Initiative</h4>
        <p>
            Sebagai Engineering Support, pengelolaan energi bukan sekadar angka,
            melainkan tanggung jawab operasional. Kami menerapkan strategi
            optimasi pada sistem HVAC dan pencahayaan, serupa dengan audit
            energi yang telah dilakukan di berbagai fasilitas kritis untuk
            menekan emisi karbon dan biaya operasional.
        </p>
        <div class="d-flex gap-3 mt-3">
            <span class="badge p-2 px-3 bg-light text-dark border">
                <i class="bi bi-check-circle-fill text-success me-2"></i> ISO 50001 Certified
            </span>
            <span class="badge p-2 px-3 bg-light text-dark border">
                <i class="bi bi-check-circle-fill text-success me-2"></i> Energy Performance Indicators
            </span>
        </div>
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>
@endsection
