<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CompanyProfile;
use App\Models\Gallery;
use App\Models\Product;

/**
 * DashboardController
 *
 * This controller for displaying the admin dashboard summary.
 */
class DashboardController extends Controller
{
    /**
     * This function for displaying the dashboard with data counts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'products' => Product::count(),
            'galleries' => Gallery::count(),
            'profiles' => CompanyProfile::count(),
        ];

        $recentArticles = Article::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentProducts'));
    }
}
