@extends('layouts.app')

@section('title', 'Edit Sistem')

@section('content')
<div class="bg-primary text-white py-5 shadow-sm">
    <div class="container py-3">
        <h1 class="fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Sistem</h1>
        <p class="lead opacity-75 mb-0">Perbarui data: {{ $system->equipment_name }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('facilities.update', $system->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Sistem <span class="text-danger">*</span></label>
                            <select name="system_category" class="form-select @error('system_category') is-invalid @enderror" required>
                                <option value="Electrical" {{ old('system_category', $system->system_category) === 'Electrical' ? 'selected' : '' }}>Electrical</option>
                                <option value="Cooling" {{ old('system_category', $system->system_category) === 'Cooling' ? 'selected' : '' }}>Cooling</option>
                                <option value="Security" {{ old('system_category', $system->system_category) === 'Security' ? 'selected' : '' }}>Security</option>
                                <option value="Networking" {{ old('system_category', $system->system_category) === 'Networking' ? 'selected' : '' }}>Networking</option>
                                <option value="Fire Suppression" {{ old('system_category', $system->system_category) === 'Fire Suppression' ? 'selected' : '' }}>Fire Suppression</option>
                            </select>
                            @error('system_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Peralatan <span class="text-danger">*</span></label>
                            <input type="text" name="equipment_name" class="form-control @error('equipment_name') is-invalid @enderror"
                                   value="{{ old('equipment_name', $system->equipment_name) }}" required>
                            @error('equipment_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{ old('description', $system->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="Active" {{ old('status', $system->status) === 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status', $system->status) === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Maintenance" {{ old('status', $system->status) === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Perbarui
                            </button>
                            <a href="{{ url('/infrastructure') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
