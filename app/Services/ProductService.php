<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Product;

class ProductService implements IProductService
{
    const IMAGE_FOLDER = 'photos/';

    public function store(ProductRequest $request): Product
    {
        return $this->saveProduct(new Product(),  $request);
    }

    public function update(Product $product, ProductRequest $request): Product
    {
        return $this->saveProduct($product, $request);
    }

    protected function saveProduct(Product $product, ProductRequest $request): Product
    {
        $product->fill([
            'name' => $request->getName(),
            'description' => $request->getDescription(),
            'price' => $request->getPrice(),
        ]);
        $product->save();

        $this->attachCategories($product, $request->getCategories());
        $this->storeImages($product, $request->getImages(), $request->getMainImage());

        return $product;
    }

    protected function attachCategories(Product $product, array $categories): void
    {
        $product->categories()->detach();
        $product->categories()->attach($categories);
    }

    protected function storeImages(Product $product, array $images, string $mainImage): void
    {
        $product->images()->update(['is_main' => 0]);

        foreach ($images as $image) {
            if ($this->isUploadedFile($image)) {
                $this->handleUploadedFile($product, $image, $mainImage);
            } else {
                $this->updateExistingImage($image['path'], $mainImage);
            }
        }
    }

    protected function isUploadedFile($image): bool
    {
        return !is_array($image);
    }

    protected function handleUploadedFile(Product $product, $image, string $mainImage): void
    {
        $originalName = $image->getFileName();
        $fileName = $image->storeAs('photos', \Str::random(40) . '.' . $image->getClientOriginalExtension());
        $isMain = $mainImage === $originalName;

        $product->images()->save(new Image([
            'path' => $fileName,
            'is_main' => $isMain,
        ]));
    }

    protected function updateExistingImage(string $imagePath, string $mainImage): void
    {
        $isMain = $mainImage === $imagePath;
        Image::where('path', $imagePath)->update(['is_main' => $isMain]);
    }
}
