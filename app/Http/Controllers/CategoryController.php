<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $user = auth()->user();
        $categories = Category::all();
        return view('categories.index')
            ->with('categories', $categories)
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::all();
        return view('categories.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'parent' => 'required|string|max:255',
        ]);
        $category = Category::create($valid);
        return to_route('categories.show', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category): View|Factory|Application
    {
        return view('categories.show')
            ->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        $categories = Category::all();
        return view('categories.edit')
            ->with('category', $category)
            ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'parent' => 'required|string|max:255',
        ]);
        $category->update($valid);
        return to_route('categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return to_route('categories.index');
    }

    /**
     * Show specified list of products.
     *
     * @param Category $category
     * @return Factory|View|Application
     */
    public function productList(Category $category): Factory|View|Application
    {
        $products = Product::all()->where('category_id', '==', $category->id);
        return view('products.index')
            ->with('products', $products)
            ->with('categories', Category::all())
            ->with('user', auth()->user());
    }
}
