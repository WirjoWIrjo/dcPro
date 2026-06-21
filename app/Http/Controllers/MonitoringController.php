<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Traits\DemoMode;
use App\Models\EnergyMetric;
use App\Models\Article;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    use DemoMode;
    public function index()
    {
        $metrics = EnergyMetric::orderByDesc('created_at')->get();
        return view('pages.sustainability', compact('metrics'));
    }

    // Energy Metrics CRUD

    public function showMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        return view('pages.metric-show', compact('metric'));
    }

    public function createMetric()
    {
        return view('pages.metric-create');
    }

    public function storeMetric(Request $request)
    {
        $validated = $request->validate([
            'period'            => ['required', 'string', 'max:100'],
            'pue_value'        => ['required', 'numeric', 'min:0'],
            'total_consumption'=> ['required', 'numeric', 'min:0'],
        ]);

        EnergyMetric::create($validated + ['is_demo' => $this->isDemoRecord()]);

        session()->flash('success', 'Metric baru berhasil ditambahkan.');
        return redirect()->route('monitoring.index');
    }

    public function editMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        return view('pages.metric-edit', compact('metric'));
    }

    public function updateMetric(Request $request, int $id)
    {
        $validated = $request->validate([
            'period'            => ['required', 'string', 'max:100'],
            'pue_value'        => ['required', 'numeric', 'min:0'],
            'total_consumption'=> ['required', 'numeric', 'min:0'],
        ]);

        $metric = EnergyMetric::findOrFail($id);
        $validated['is_demo'] = $this->isDemoRecord();
        $metric->update($validated);

        session()->flash('success', 'Metric berhasil diperbarui.');
        return redirect()->route('monitoring.index');
    }

    public function destroyMetric(int $id)
    {
        $metric = EnergyMetric::findOrFail($id);
        $metric->delete();

        session()->flash('success', 'Metric berhasil dihapus.');
        return redirect()->route('monitoring.index');
    }

    // Articles (public)

    public function indexArtikel()
    {
        $articles = Article::latest()->get();
        return view('pages.article', compact('articles'));
    }

    public function showArticle(int $id)
    {
        $article = Article::findOrFail($id);
        return view('pages.article-show', compact('article'));
    }

    public function createArticle()
    {
        return view('pages.article-create');
    }

    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
        ]);

        Article::create($validated + ['is_demo' => $this->isDemoRecord()]);

        session()->flash('success', 'Artikel baru berhasil dipublikasikan.');
        return redirect()->route('monitoring.indexArtikel');
    }

    public function editArticle(int $id)
    {
        $article = Article::findOrFail($id);
        return view('pages.article-edit', compact('article'));
    }

    public function updateArticle(Request $request, int $id)
    {
        $validated = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
        ]);

        $article = Article::findOrFail($id);
        $validated['is_demo'] = $this->isDemoRecord();
        $article->update($validated);

        session()->flash('success', 'Artikel berhasil diperbarui.');
        return redirect()->route('monitoring.indexArtikel');
    }

    public function destroyArticle(int $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        session()->flash('success', 'Artikel berhasil dihapus.');
        return redirect()->route('monitoring.indexArtikel');
    }

    // API helpers

    public function apiMetrics()
    {
        $metrics = EnergyMetric::orderByDesc('created_at')->get();

        return response()->json([
            'success' => true,
            'data'    => $metrics,
        ]);
    }

    public function apiArticles()
    {
        $articles = Article::latest()->take(5)->get();

        return response()->json([
            'success' => true,
            'data'    => $articles,
        ]);
    }
}
