<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Services\IUserService;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UpdateUser extends Component
{

    public UserForm $form;
    public $isEdit = true;
    public function render()
    {
        return view('livewire.users.create-user')->layout('layouts.app');
    }

    public function mount(User $user)
    {
        $this->form->roles = $this->form->roles();
        $this->form->user = $user;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->userRoles = $user->roles->pluck('id')->toArray();
        $this->form->isEdit = $this->isEdit;
    }

    public function save(IUserService $userService)
    {
        $this->form->update($this->form->user, $userService);
        session()->flash('status', 'User successfully updated.');
        $this->redirectRoute('update-user', ['user' => $this->form->user]);
    }
}
