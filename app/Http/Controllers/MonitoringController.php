<?php

namespace App\Http\Controllers;

use App\Models\EnergyMetric;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * MonitoringController
 *
 * This controller for managing energy metrics and articles.
 * It handles both sustainability dashboard and article CRUD operations.
 */
class MonitoringController extends Controller
{
    // -----------------------------------------------------------------
    // ENERGY METRICS SECTION
    // -----------------------------------------------------------------

    /**
     * This function for displaying the sustainability dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $metrics = EnergyMetric::orderByDesc('created_at')->get();

        return view('pages.sustainability', compact('metrics'));
    }

    /**
     * This function for showing a single metric detail.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        return view('pages.metric-show', compact('metric'));
    }

    /**
     * This function for showing the metric creation form.
     *
     * @return \Illuminate\View\View
     */
    public function createMetric()
    {
        return view('pages.metric-create');
    }

    /**
     * This function for storing a new metric to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMetric(Request $request)
    {
        $validated = $request->validate([
            'period'            => ['required', 'string', 'max:100'],
            'pue_value'        => ['required', 'numeric', 'min:0'],
            'total_consumption'=> ['required', 'numeric', 'min:0'],
        ]);

        EnergyMetric::create($validated);

        session()->flash('success', 'Metric baru berhasil ditambahkan.');
        return redirect()->route('monitoring.index');
    }

    /**
     * This function for showing the metric edit form.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        return view('pages.metric-edit', compact('metric'));
    }

    /**
     * This function for updating an existing metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMetric(Request $request, int $id)
    {
        $validated = $request->validate([
            'period'            => ['required', 'string', 'max:100'],
            'pue_value'        => ['required', 'numeric', 'min:0'],
            'total_consumption'=> ['required', 'numeric', 'min:0'],
        ]);

        $metric = EnergyMetric::findOrFail($id);
        $metric->update($validated);

        session()->flash('success', 'Metric berhasil diperbarui.');
        return redirect()->route('monitoring.index');
    }

    /**
     * This function for deleting a metric from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        $metric->delete();

        session()->flash('success', 'Metric berhasil dihapus.');
        return redirect()->route('monitoring.index');
    }

    // -----------------------------------------------------------------
    // ARTICLE SECTION
    // -----------------------------------------------------------------

    /**
     * This function for displaying the article listing page.
     *
     * @return \Illuminate\View\View
     */
    public function indexArtikel()
    {
        $articles = Article::latest()->get();

        return view('pages.article', compact('articles'));
    }

    /**
     * This function for showing a single article detail.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showArticle(int $id)
    {
        $article = Article::findOrFail($id);
        return view('pages.article-show', compact('article'));
    }

    /**
     * This function for showing the article creation form.
     *
     * @return \Illuminate\View\View
     */
    public function createArticle()
    {
        return view('pages.article-create');
    }

    /**
     * This function for storing a new article to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
        ]);

        Article::create($validated);

        session()->flash('success', 'Artikel baru berhasil dipublikasikan.');
        return redirect()->route('monitoring.indexArtikel');
    }

    /**
     * This function for showing the article edit form.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editArticle(int $id)
    {
        $article = Article::findOrFail($id);
        return view('pages.article-edit', compact('article'));
    }

    /**
     * This function for updating an existing article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateArticle(Request $request, int $id)
    {
        $validated = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
        ]);

        $article = Article::findOrFail($id);
        $article->update($validated);

        session()->flash('success', 'Artikel berhasil diperbarui.');
        return redirect()->route('monitoring.indexArtikel');
    }

    /**
     * This function for deleting an article from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyArticle(int $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        session()->flash('success', 'Artikel berhasil dihapus.');
        return redirect()->route('monitoring.indexArtikel');
    }

    // -----------------------------------------------------------------
    // API HELPER METHODS
    // -----------------------------------------------------------------

    /**
     * This function for returning metrics as JSON for API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiMetrics()
    {
        $metrics = EnergyMetric::orderByDesc('created_at')->get();

        return response()->json([
            'success' => true,
            'data'    => $metrics,
        ]);
    }

    /**
     * This function for returning latest articles as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiArticles()
    {
        $articles = Article::latest()->take(5)->get();

        return response()->json([
            'success' => true,
            'data'    => $articles,
        ]);
    }
}
