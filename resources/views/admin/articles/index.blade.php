@extends('admin.layouts.app')

@section('title', 'Kelola Artikel')
@section('page-heading', 'Artikel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Artikel
        </a>
        <a href="{{ route('admin.reports.articles') }}" class="btn btn-outline-danger ms-2" target="_blank">
            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
        </a>
    </div>
    <form method="GET" class="d-flex" style="max-width:300px;">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari artikel..." value="{{ request('search') }}">
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" alt="" class="rounded" width="50" height="50" style="object-fit:cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold">{{ Str::limit($article->title, 50) }}</span>
                        </td>
                        <td><span class="badge bg-primary-soft text-primary">{{ $article->category }}</span></td>
                        <td class="text-muted small">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-sm btn-outline-info" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Tidak ada data artikel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        {{ $articles->links() }}
    </div>
</div>
@endsection
