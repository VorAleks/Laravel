<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use App\Queries\SourcesQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;
    protected QueryBuilder $newsQueryBuilder;
    protected QueryBuilder $sourcesQueryBuilder;

    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
        NewsQueryBuilder $newsQueryBuilder,
        SourcesQueryBuilder $sourcesQueryBuilder
    )
    {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
        $this->newsQueryBuilder = $newsQueryBuilder;
        $this->sourcesQueryBuilder = $sourcesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.news.index', [
            'newsList' => $this->newsQueryBuilder->getAll()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.news.create', [
            'categories' => $this->categoriesQueryBuilder->getAll(),
            'sources' => $this->sourcesQueryBuilder->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            ]);
        $categories = $request->input('categories');
        $sources = $request->input('sources');

        $news = $request->only(['title', 'author', 'status', 'description']);
        $news = News::create($news);
        if ($news !== false) {
            if ($categories !== null && $sources !== null) {
                $news->categories()->attach($categories);
                $news->sources()->attach($sources);

                return \redirect()->route('admin.news.index')->with('success', 'News has been create');
            }
        }
         return \back()->with('error', 'News has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): View
    {
        return \view('admin.news.edit', [
                'news' => $news,
                'categories' => $this->categoriesQueryBuilder->getAll(),
                'sources' => $this->sourcesQueryBuilder->getAll()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news): RedirectResponse
    {
        $categories = $request->input('categories');
        $sources = $request->input('sources');
        $news = $news->fill($request->only(['title', 'author', 'status', 'description']));
        if ($news->save()) {
            $news->categories()->sync($categories);
            $news->sources()->sync($sources);

            return \redirect()->route('admin.news.index')->with('success', 'News has been update');
        }
        return \back()->with('error', 'News has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
