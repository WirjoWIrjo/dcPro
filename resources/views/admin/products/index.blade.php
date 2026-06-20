@extends('admin.layouts.app')

@section('title', 'Kelola Produk')
@section('page-heading', 'Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Tambah Produk
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="" class="rounded" width="50" height="50" style="object-fit:cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                    <i class="bi bi-box text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td><span class="fw-semibold">{{ Str::limit($product->name, 40) }}</span></td>
                        <td><span class="badge bg-success-soft text-success">{{ $product->category ?? '-' }}</span></td>
                        <td>{{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">
                                {{ $product->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Tidak ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        {{ $products->links() }}
    </div>
</div>
@endsection
