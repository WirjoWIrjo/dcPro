@extends('layouts.app')

@section('title', 'Detail Highlight')

@section('content')
<div class="bg-primary text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-info-circle me-2"></i> Detail Highlight</h1>
        <p class="lead opacity-75 mb-0">Detail data metrik: {{ $highlight->metric_name }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi {{ $highlight->icon }} text-primary p-3 bg-primary bg-opacity-10 rounded-circle"
                           style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="fw-bold">{{ $highlight->metric_value }}</h2>
                    <p class="text-muted text-uppercase fw-semibold">{{ $highlight->metric_name }}</p>
                    <hr>
                    <div class="row text-start">
                        <div class="col-sm-4 fw-semibold text-muted">Icon</div>
                        <div class="col-sm-8"><code>{{ $highlight->icon }}</code></div>
                    </div>
                    <hr>
                    <div class="row text-start">
                        <div class="col-sm-4 fw-semibold text-muted">Dibuat pada</div>
                        <div class="col-sm-8">{{ $highlight->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-4 text-center">
                    <a href="{{ url('/') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
