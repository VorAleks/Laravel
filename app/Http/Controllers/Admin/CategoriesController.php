<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\Store;
use App\Http\Requests\Categories\Update;
use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;

    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
    )
    {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.categories.index', ['categoriesList' => $this->categoriesQueryBuilder->getAllPaginate()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        if ($category) {
            return \redirect()->route('admin.categories.index')->with('success', 'Category has been create');
        }
        return \back()->with('error', 'Category has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return \view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Category $category): RedirectResponse
    {
        $category = $category->fill($request->validated());
        if ($category->save()) {
            return \redirect()->route('admin.categories.index')->with('success', 'Category has been update');
        }
        return \back()->with('error', 'Category has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return \response()->json('ok');
        } catch (\Throwable $exception) {
            \log::error($exception->getMessage(),$exception->getTrace());

            return \response()->json('error', 400);
        }
    }
}
