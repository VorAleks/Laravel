<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\Store;
use App\Http\Requests\News\Update;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use App\Queries\SourcesQueryBuilder;
use App\Services\Contracts\Upload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
            'newsList' => $this->newsQueryBuilder->getAllPaginate()
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
    public function store(Store $request): RedirectResponse
    {

        $news = News::create($request->validated());
        if ($news) {

                $news->categories()->attach($request->getCategories());
                $news->sources()->attach($request->getSources());

                return \redirect()->route('admin.news.index')->with('success', __('News has been created'));
        }
         return \back()->with('error', __('News has not been created'));
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
    public function update(Update $request, News $news, Upload $upload): RedirectResponse
    {
        $news = $news->fill($request->validated());

        if ($request->hasFile('image')) {
            $news['image'] = $upload->create($request->file('image'));
        }

        if ($news->save()) {
            $news->categories()->sync($request->getCategories());
            $news->sources()->sync($request->getSources());

            return \redirect()->route('admin.news.index')->with('success', __('News has been updated'));
        }
        return \back()->with('error', __('News has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        try {
            $news->delete();

            return \response()->json('ok');
        } catch (\Throwable $exception) {
            \log::error($exception->getMessage(), $exception->getTrace());

            return \response()->json('error', 400);
        }
    }
}
