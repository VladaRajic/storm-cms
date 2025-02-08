<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ListProduct extends Component
{
    public $products;
    public function render()
    {
        return view('livewire.products.list-product')->layout('layouts.app');
    }

    public function mount()
    {
        $this->products = Product::all();
    }
}
