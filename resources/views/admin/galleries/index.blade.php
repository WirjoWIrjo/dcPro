@extends('admin.layouts.app')

@section('title', 'Kelola Galeri')
@section('page-heading', 'Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-lg me-1"></i> Tambah Galeri
    </a>
</div>

<div class="row g-3">
    @forelse($galleries as $item)
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <img src="{{ asset($item->image) }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $item->title }}">
            <div class="card-body p-3">
                <h6 class="card-title fw-bold mb-1">{{ Str::limit($item->title, 30) }}</h6>
                @if($item->category)
                    <span class="badge bg-warning-soft text-warning mb-2">{{ $item->category }}</span>
                @endif
                <p class="card-text small text-muted mb-0">{{ Str::limit($item->caption, 50) }}</p>
            </div>
            <div class="card-footer bg-white border-0 d-flex gap-1">
                <a href="{{ route('admin.galleries.edit', $item) }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="d-inline flex-grow-1"
                      onsubmit="return confirm('Yakin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">
        <i class="bi bi-images display-1"></i>
        <p class="mt-3">Belum ada gambar di galeri.</p>
    </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $galleries->links() }}
</div>
@endsection
