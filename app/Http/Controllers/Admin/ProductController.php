<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('product.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
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
     * @param \App\Models\Product $product
     * @return Application|Factory|View
     */
    public function show(Product $product)
    {
        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product)
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
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
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
