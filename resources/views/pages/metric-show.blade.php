@extends('layouts.app')

@section('title', 'Detail Metrik Energi')

@section('content')
<div class="bg-success text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-bar-chart-line me-2"></i> Detail Metrik Energi</h1>
        <p class="lead opacity-75 mb-0">Detail data energi untuk periode {{ $metric->period }}.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Periode</div>
                        <div class="col-sm-8">{{ $metric->period }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">PUE Value</div>
                        <div class="col-sm-8"><span class="badge bg-success fs-6">{{ $metric->pue_value }}</span></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Total Consumption</div>
                        <div class="col-sm-8">{{ number_format($metric->total_consumption) }} kWh</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Dicatat pada</div>
                        <div class="col-sm-8">{{ $metric->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-4">
                    <a href="{{ url('/sustainability') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
