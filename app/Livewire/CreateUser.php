<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Services\IUserService;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    public UserForm $form;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.users.create-user')->layout('layouts.app');
    }

    public function mount()
    {
        $this->form->roles = Role::all();
        $this->form->isEdit = $this->isEdit;
    }

    public function save(IUserService $userService)
    {
       $this->form->store($userService);

       $this->redirect(route('list-user'));
    }
}
