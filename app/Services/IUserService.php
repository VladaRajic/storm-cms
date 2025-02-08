<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;

interface IUserService
{
    public function store(UserRequest $request): User;
    public function update(User $user, UserRequest $request): User;
}
