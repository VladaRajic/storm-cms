<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    const NAME = 'name';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const ROLES = 'roles';

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return $this->input(self::NAME);
    }
    public function getEmail(): string
    {
        return $this->input(self::EMAIL);
    }

    public function getUserPassword(): string
    {
        return $this->input(self::NAME);
    }

    public function getRoles(): array
    {
        return $this->input(self::ROLES);
    }
}
