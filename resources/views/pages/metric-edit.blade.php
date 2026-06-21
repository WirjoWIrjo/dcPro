@extends('layouts.app')

@section('title', 'Edit Metrik Energi')

@section('content')
<div class="bg-success text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Metrik Energi</h1>
        <p class="lead opacity-75 mb-0">Perbarui data metrik untuk periode {{ $metric->period }}.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('monitoring.updateMetric', $metric->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Periode <span class="text-danger">*</span></label>
                            <input type="text" name="period" class="form-control @error('period') is-invalid @enderror"
                                   value="{{ old('period', $metric->period) }}" required>
                            @error('period')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">PUE Value <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="pue_value" class="form-control @error('pue_value') is-invalid @enderror"
                                   value="{{ old('pue_value', $metric->pue_value) }}" required>
                            @error('pue_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Total Consumption (kWh) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="total_consumption" class="form-control @error('total_consumption') is-invalid @enderror"
                                   value="{{ old('total_consumption', $metric->total_consumption) }}" required>
                            @error('total_consumption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-lg me-1"></i> Perbarui
                            </button>
                            <a href="{{ url('/sustainability') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
