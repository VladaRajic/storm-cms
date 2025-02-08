<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryCreateForm extends Form
{
    #[Validate(['required'])]
    public $name = '';

    #[Validate(['nullable', 'integer'])]
    public $parent_id = '';
}
