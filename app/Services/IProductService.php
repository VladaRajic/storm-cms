<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Ramsey\Collection\Collection;

interface IProductService
{
    public function store(ProductRequest $request): Product;
    public function update(Product $product, ProductRequest $request): Product;
}
