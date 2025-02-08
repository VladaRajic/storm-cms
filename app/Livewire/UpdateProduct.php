<?php

namespace App\Livewire;

use App\Livewire\Forms\CommentForm;
use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Services\ICommentService;
use App\Services\IProductService;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public CommentForm $commentForm;
    public  $isEdit = true;
    public function render()
    {
        return view('livewire.products.products')->layout('layouts.app');
    }

    public function mount(Product $product): void
    {

        $this->form->product = $product;
        $this->form->categories = Category::all();
        $this->form->name = $product->name;
        $this->form->description = $product->description;
        $this->form->price = $product->price;
        $this->form->comments = $product->comments;
        $this->form->images = $product->images;
        $this->form->productCategories = $product->categories->pluck('id')->toArray();
        $this->form->mainImage = $this->getMainImagePath($product);
    }

    public function save(IProductService $productService): void
    {
        $this->form->update($productService);
    }

    public function deleteComment(int $id, ICommentService $commentService): void
    {
        $commentService->delete($id, $this->form->product->id);
    }

    protected function getMainImagePath(Product $product): string
    {
        return Image::where('product_id', $product->id)
            ->mainImage()
            ->value('path') ?? '';
    }

}
