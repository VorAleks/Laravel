<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Source;
use App\Queries\QueryBuilder;
use App\Queries\SourcesQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SourcesController extends Controller
{
    protected QueryBuilder $sourcesQueryBuilder;

    public function __construct(
        SourcesQueryBuilder $sourcesQueryBuilder,
    )
    {
        $this->sourcesQueryBuilder = $sourcesQueryBuilder;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.sources.index', [
            'sourcesList' => $this->sourcesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.sources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);

        $source = $request->only(['title', 'url']);
        $source = Source::create($source);
        if ($source !== false) {
            return \redirect()->route('admin.sources.index')->with('success', 'Source has been create');
        }
        return \back()->with('error', 'Source has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Source $source)
    {
        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Source $source): View
    {
        return \view('admin.sources.edit', ['source' => $source]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Source $source): RedirectResponse
    {
        $source = $source->fill($request->only(['title', 'url']));
        if ($source->save()) {
            return \redirect()->route('admin.sources.index')->with('success', 'Source has been update');
        }
        return \back()->with('error', 'Source has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Source $source)
    {
        //
    }
}
