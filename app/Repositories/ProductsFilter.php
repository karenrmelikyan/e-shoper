<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductsFilter implements Contracts\ProductsFilterInterface
{
    public function getByPricesRange(array $rangeIndexes = [])
    {
        if (empty($rangeIndexes)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }

        $query = Product::where('price', '=', 0);
        foreach ($rangeIndexes as $minValue) {
            $maxValue = $minValue + 100;
            $query->orWhereBetween('price', [$minValue, $maxValue]);
        }

        return $query->get();
    }

    public function getByCategories(array $categories = []): Collection
    {
        if (empty($categories)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }

        return Product::whereIn('category_id', $categories)->get();
    }

    public function getByColors(array $colors = []): Collection
    {
        if (empty($colors)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }

        return Product::whereHas('colors', static function ($query) use ($colors) {
            $query->whereIn('colors.id', $colors);
        })->with('colors')->get();
    }

    public function getByTags(array $tags = []): Collection
    {
        if (empty($tags)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }

        return Product::whereHas('tags', static function ($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        })->with('tags')->get();
    }

}
