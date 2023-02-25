<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Color;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::all();

        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $colors = Color::all();

        return view('product.create', [
            'categories' => $categories,
            'tags' => $tags,
            'colors' => $colors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // save picture to storage & get path to it
        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        // remove extra data "tags" from data
        $tagIDs = $data['tags'];
        unset($data['tags']);

        $product = Product::firstOrCreate($data);

        // set correct tag's IDs
        $product->tags()->attach($tagIDs);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $colors = Color::all();

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
            'tags' => $tags,
            'colors' => $colors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        // remove extra data "tags" from data
        $tagIDs = $data['tags'];
        unset($data['tags']);

        // sync method useful during update
        $product->tags()->sync($tagIDs);

        $product->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        // access to pivot columns
//        foreach ($product->tags as $tag) {
//            echo $tag->pivot->tag_id;
//        }

        // delete restrictions before removing
        $product->tags()->detach();
        $product->delete();

        return redirect()->route('product.index');
    }
}
