<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * ReportController
 *
 * This controller for generating PDF reports in admin panel.
 */
class ReportController extends Controller
{
    /**
     * This function for generating and downloading articles PDF report.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articlesPdf()
    {
        $articles = Article::latest()->get();

        $pdf = Pdf::loadView('admin.reports.articles-pdf', compact('articles'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-artikel-' . date('Y-m-d') . '.pdf');
    }
}
