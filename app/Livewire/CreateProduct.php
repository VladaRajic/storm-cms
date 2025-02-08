<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Services\IProductService;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    public $isEdit = false;

    protected $productService;

    public function render()
    {
        return view('livewire.products.products')->layout('layouts.app');
    }

    public function mount()
    {
        $this->form->categories = Category::all();
    }

    public function save(IProductService $productService)
    {
        //dd($this->form->mainImage);
        $this->form->create($productService);
    }
}
