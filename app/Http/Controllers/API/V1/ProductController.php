<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $allProducts = Product::all();

        return ProductResource::collection($allProducts);
    }

    public function detail(int $productID): ProductResource
    {
        $product = Product::find($productID);

        return new ProductResource($product);
    }

    public function getCartProducts(Request $request): AnonymousResourceCollection
    {
        $cartProducts = Product::whereIn('id', $request['IDs'])->get();

        return ProductResource::collection($cartProducts);
    }
}
