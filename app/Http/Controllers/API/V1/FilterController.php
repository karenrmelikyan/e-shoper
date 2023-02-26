<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\Contracts\ProductsFilterInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\API\Filter\IndexRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FilterController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        $colors = Color::all();
        $tags = Tag::all();

        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        $response = [
            'categories' => $categories,
            'colors' => $colors,
            'tags' => $tags,
            'price' => [
                'min' => $minPrice,
                'max' => $maxPrice,
            ]
        ];

        return response()->json($response);
    }

    public function getFiltered(IndexRequest $request, ProductsFilterInterface $productFilter): AnonymousResourceCollection
    {
        $data = $request->validated();

        $productsByCategories = $productFilter->getByCategories($data['categories']);
        $productsByColors = $productFilter->getByColors($data['colors']);
        $productsByTags = $productFilter->getByTags($data['tags']);

        // merge all collections for sorting by unique
        $uniqueCollection = $productsByCategories
            ->merge($productsByColors)
            ->merge($productsByTags)
            ->unique();

        return ProductResource::collection($uniqueCollection->all());
    }

}
