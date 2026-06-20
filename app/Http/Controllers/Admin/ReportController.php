<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function articlesPdf()
    {
        $articles = Article::latest()->get();

        $pdf = Pdf::loadView('admin.reports.articles-pdf', compact('articles'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-artikel-' . date('Y-m-d') . '.pdf');
    }
}
