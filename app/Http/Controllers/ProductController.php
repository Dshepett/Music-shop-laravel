<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = Category::all();
        $user = auth()->user();
        $products = Product::all();
        return view('products.index')
            ->with('products', $products)
            ->with('user', $user)
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::all();
        return view('products.create')
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
            'price' => 'numeric',
            'category_id' => 'required|numeric',
            'image_url' => 'max:255'
        ]);
        $product = Product::create($valid);
        return to_route('products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function show(Product $product): View|Factory|Application
    {
        $category_name = Category::where('id', '=', $product->category_id)->first()->name;
        return view('products.show')
            ->with('product', $product)
            ->with('category_name', $category_name)
            ->with('user', auth()->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::all();
        return view('products.edit')
            ->with('product', $product)
            ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'price' => 'numeric',
            'category_id' => 'required|numeric',
            'image_url' => 'max:255'
        ]);

        $product->update($valid);
        return to_route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return to_route('products.index');
    }
}
