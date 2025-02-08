<?php

namespace App\Livewire\Forms;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\IUserService;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class UserForm extends Form
{
    public ?User $user;
    public $isEdit = false;

    public $name = '';
    public $email = '';
    public $password = '';

    public $roles = [];
    public $userRoles = [];

    public function rules(): array
    {
        $email = 'required|email';
        if($this->isEdit){
            $email = 'required|email|unique:users,email,'.$this->user->id;
        }
        $rules = [
            'name' => 'required',
            'email' => $email,
            'userRoles' => 'required|array'
        ];

        if(!$this->isEdit){
            $rules['password'] = 'required';
        }

        return  $rules;
    }


    public function store(IUserService $userService): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'roles' => $this->userRoles,
        ];

        $userService->store(new UserRequest($data));

    }

    public function update(User $user, IUserService $userService): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->userRoles,
        ];

        $userService->update($user, new UserRequest($data));
    }

    public function roles()
    {
        return Role::all();
    }

}
