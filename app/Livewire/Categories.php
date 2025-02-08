<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Categories extends Component
{
    public $categories = [];

    #[Validate('required')]
    public $categoryName;
    public $parentId;


    public function render()
    {

        return view('livewire.categories.categories')->layout('layouts.app');
    }

    public function mount()
    {
        $this->categories = Category::all();

    }

    public function save(): void
    {
        $this->validate();
        Category::create([
            'name' => $this->categoryName,
            'parent_id' => $this->parentId
        ]);

        $this->dispatch('category-created', name: $this->categoryName);
        $this->redirect('/categories', navigate: true);
    }

    public function delete(Category $category): void
    {
        $category->delete();
        $this->redirect('/categories', navigate: true);
    }
}
