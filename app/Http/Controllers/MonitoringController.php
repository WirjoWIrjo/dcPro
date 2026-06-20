<?php

namespace App\Http\Controllers;

use App\Models\EnergyMetric;   // Model that stores PUE / consumption data
use App\Models\Article;       // Model for the sustainability blog posts
use Illuminate\Http\Request;  // Handles incoming HTTP request data

/**
 * MonitoringController
 *
 * Centralises all actions that deal with the **energy‑monitoring**
 * dashboard and the **sustainability articles** section.
 *
 * The original snippet only returned a list of metrics and a list of
 * articles.  Below we keep those two index methods intact and extend
 * the controller with a full set of CRUD operations for both resources,
 * plus a few helpful helper methods (e.g., JSON response).
 */
class MonitoringController extends Controller
{
    // -----------------------------------------------------------------
    // ENERGY METRICS SECTION
    // -----------------------------------------------------------------

    /**
     * Show the sustainability dashboard (list of energy metrics).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You may want to paginate if the table grows: ->paginate(12)
        $metrics = EnergyMetric::orderByDesc('created_at')->get();

        return view('pages.sustainability', compact('metrics'));
    }

    /**
     * Show a single metric in a dedicated view (optional).
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
     * Show the form for creating a new metric.
     *
     * @return \Illuminate\View\View
     */
    public function createMetric()
    {
        return view('pages.metric-create');
    }

    /**
     * Store a newly created metric.
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
     * Show the form for editing an existing metric.
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
     * Update an existing metric.
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
     * Delete a metric.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        $metric->delete(); // SoftDeletes will only flag the row

        session()->flash('success', 'Metric berhasil dihapus.');
        return redirect()->route('monitoring.index');
    }

    // -----------------------------------------------------------------
    // ARTICLE SECTION
    // -----------------------------------------------------------------

    /**
     * Show the article listing page.
     *
     * The original method was called `indexArtikel`; we keep the route name
     * but also expose a more conventional `articlesIndex` for future use.
     *
     * @return \Illuminate\View\View
     */
    public function indexArtikel()
    {
        // Latest first – you could add pagination: ->paginate(9)
        $articles = Article::latest()->get();

        // Note: Blade view file names are case‑sensitive on some OSes;
        // using lowercase 'article' keeps things consistent.
        return view('pages.article', compact('articles'));
    }

    /**
     * Show a single article.
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
     * Show the form to create a new article.
     *
     * @return \Illuminate\View\View
     */
    public function createArticle()
    {
        return view('pages.article-create');
    }

    /**
     * Store a newly created article.
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
            // Optional image upload could be added here
        ]);

        Article::create($validated);

        session()->flash('success', 'Artikel baru berhasil dipublikasikan.');
        return redirect()->route('monitoring.indexArtikel');
    }

    /**
     * Show the edit form for an existing article.
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
     * Update an existing article.
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
     * Delete an article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyArticle(int $id)
    {
        $article = Article::findOrFail($id);
        $article->delete(); // SoftDeletes if enabled

        session()->flash('success', 'Artikel berhasil dihapus.');
        return redirect()->route('monitoring.indexArtikel');
    }

    // -----------------------------------------------------------------
    // OPTIONAL HELPER METHODS
    // -----------------------------------------------------------------

    /**
     * Return metrics as JSON for API consumers.
     *
     * Demonstrates how you could expose a read‑only endpoint.
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
     * Return latest articles as JSON.
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