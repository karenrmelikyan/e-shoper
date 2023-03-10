<?php

namespace App\Repositories\Contracts;

interface ProductsFilterInterface
{
    public function getByPricesRange(array $rangeIndexes);
    public function getByCategories(array $categories);
    public function getByColors(array $colors);
    public function getByTags(array $tags);
}
