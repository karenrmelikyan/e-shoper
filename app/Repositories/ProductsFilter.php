<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductsFilter implements Contracts\ProductsFilterInterface
{
    public function getByPriceRange(array $rangeIndexes = []): Collection
    {
        if (empty($rangeIndexes)) {
            return new \Illuminate\Database\Eloquent\Collection([]);
        }

        $min = min($rangeIndexes);
        $max = max($rangeIndexes) + 100;

        return Product::whereBetween('price', [$min, $max])->get();
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
