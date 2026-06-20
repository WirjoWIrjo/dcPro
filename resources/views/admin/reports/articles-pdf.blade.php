<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Artikel - {{ date('d M Y') }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px solid #0d6efd; padding-bottom: 15px; }
        .header h1 { font-size: 18px; color: #0d6efd; margin-bottom: 5px; }
        .header p { font-size: 11px; color: #666; }
        .info { margin-bottom: 15px; font-size: 11px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #dee2e6; padding: 8px 10px; text-align: left; font-size: 11px; }
        th { background-color: #0d6efd; color: #fff; font-weight: 600; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #dee2e6; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ARTIKEL</h1>
        <p>DataCenterPro - Engineering Support Department</p>
    </div>

    <div class="info">
        <p>Tanggal Cetak: {{ date('d M Y H:i') }}</p>
        <p>Total Artikel: {{ $articles->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal Publikasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $index => $article)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->category }}</td>
                <td>{{ $article->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada data artikel.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem DataCenterPro.</p>
        <p>&copy; {{ date('Y') }} DataCenterPro. All rights reserved.</p>
    </div>
</body>
</html>
