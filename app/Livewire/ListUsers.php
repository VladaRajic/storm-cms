<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ListUsers extends Component
{
    public $users;
    public function render()
    {
        return view('livewire.users.list-users')->layout('layouts.app');
    }

    public function mount()
    {
        $this->users = User::all();
    }
}
