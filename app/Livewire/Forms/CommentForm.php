<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    public $id;
    #[Validate(['required', 'integer'])]
    public $user_id = '';

    #[Validate(['required', 'integer'])]
    public $product_id = '';

    #[Validate(['required'])]
    public $comment = '';

    #[Validate(['required', 'integer'])]
    public $rating = '';
}
