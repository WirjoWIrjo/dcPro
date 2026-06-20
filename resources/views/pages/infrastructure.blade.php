@extends('layouts.app')

@section('title', 'Data Center Infrastructure')

@section('content')
{{-- Hero Section --}}
<div class="bg-primary text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-hdd-network me-2"></i> Infrastructure &amp; Systems</h1>
        <p class="lead opacity-75 mb-0">
            Eksplorasi infrastruktur kritikal yang menjaga operasional data center tetap berjalan 24/7 tanpa gangguan.
        </p>
    </div>
</div>

{{-- Systems Grid --}}
<div class="container py-5">
    @forelse($systems as $system)
        @if($loop->first || ($loop->index % 3 == 0))
            <div class="row g-4 mb-4">
        @endif

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                @if($system->system_category === 'Electrical')
                                    <i class="bi bi-lightning-charge text-primary fs-4"></i>
                                @elseif($system->system_category === 'Cooling')
                                    <i class="bi bi-snow text-info fs-4"></i>
                                @elseif($system->system_category === 'Security')
                                    <i class="bi bi-shield-lock text-warning fs-4"></i>
                                @else
                                    <i class="bi bi-gear text-secondary fs-4"></i>
                                @endif
                            </div>
                            <div>
                                <span class="badge bg-light text-dark mb-1">{{ $system->system_category }}</span>
                                <h5 class="card-title fw-bold mb-0">{{ $system->equipment_name }}</h5>
                            </div>
                        </div>
                        <p class="card-text text-muted">{{ $system->description }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0 pb-3">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i> {{ $system->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        @if($loop->last || ($loop->index % 3 == 2))
            </div>
        @endif
    @empty
        <div class="text-center py-5">
            <i class="bi bi-hdd-network display-1 text-muted"></i>
            <p class="mt-3 text-muted">Belum ada data infrastruktur.</p>
        </div>
    @endforelse

    {{-- Engineering Note --}}
    <div class="mt-4 p-4 bg-light rounded shadow-sm border-start border-primary border-4">
        <h5 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Engineering Note</h5>
        <p class="mb-0">
            Seluruh sistem di atas dikelola dengan standar redundansi tinggi (N+2 atau 2N) dan dipantau secara real-time melalui sistem SCADA/EMS untuk memastikan efisiensi dan keandalan maksimal.
        </p>
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>
@endsection
