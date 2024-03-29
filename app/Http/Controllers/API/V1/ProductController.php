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

    public function getProductDetails(int $productID): ProductResource
    {
        $product = Product::find($productID);

        return new ProductResource($product);
    }

    public function getCartProducts(Request $request): AnonymousResourceCollection
    {
        $cartProducts = Product::whereIn('id', $request['IDs'])->get();

        return ProductResource::collection($cartProducts);
    }

    public function getProductsByCategoryID(int $id): AnonymousResourceCollection
    {
        $products = Product::where('category_id', $id)->get();

        return ProductResource::collection($products);
    }

    public function searchProductsByTitle(string $title): AnonymousResourceCollection
    {
        $products = Product::where('title', 'LIKE', '%' . $title . '%')->get();

        return ProductResource::collection($products);
    }

    public function searchProductsByTitleAndDescription(string $q): AnonymousResourceCollection
    {
        $products = Product::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->get();

        return ProductResource::collection($products);
    }

}
