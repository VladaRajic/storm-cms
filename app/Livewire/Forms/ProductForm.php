<?php

namespace App\Livewire\Forms;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\IProductService;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{

    public ?Product $product;
    const IMAGE_FOLDER = 'photo/';

    #[Validate(['required'])]
    public $name = '';

    #[Validate(['required'])]
    public $description = '';

    #[Validate(['required', 'numeric'])]
    public $price = '';

    public $images = [];

    public $categories = [];
    public $comments = [];
    #[Validate(['required'])]
    public $productCategories = [];
    public $productImages = [];

//    #[Validate(['required'])]
    public $mainImage = '';

    public function create(IProductService $productService)
    {

        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'categories' => $this->productCategories,
            'images' => $this->images,
            'main_image' => $this->mainImage
        ];

        $productService->store(new ProductRequest($data));
        return redirect(route('list-product'));
    }

    public function update(IProductService $productService)
    {
       // dd($this->images);
        $images = $this->images instanceof Collection ? $this->images->toArray() : $this->images;
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'categories' => $this->productCategories,
            'images' => $images ?? [],
            'main_image' => $this->mainImage,
        ];
        $productService->update($this->product, new ProductRequest($data));
        return redirect(route('list-product'));
    }

    public function deleteComment()
    {
        dd('fdfd');
    }
}
