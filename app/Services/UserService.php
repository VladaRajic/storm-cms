<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserService implements IUserService
{
    public function store(UserRequest $request): User
    {
        $user = $this->createUser($request);
        $this->assignRoles($user, $request->getRoles());

        return $user;
    }

    public function update(User $user, UserRequest $request): User
    {
        $this->updateUser($user, $request);
        $this->syncRoles($user, $request->getRoles());

        return $user;
    }

    protected function createUser(UserRequest $request): User
    {
        $user = new User();
        $user->name = $request->getName();
        $user->email = $request->getEmail();
        $user->password = \Hash::make($request->getUserPassword());
        $user->save();

        return $user;
    }

    protected function updateUser(User $user, UserRequest $request): void
    {
        $user->name = $request->getName();
        $user->email = $request->getEmail();
        $user->save();
    }

    protected function assignRoles(User $user, array $roles): void
    {
        foreach ($roles as $roleId) {
            $role = Role::find($roleId);
            if ($role) {
                $user->assignRole($role);
            }
        }
    }

    protected function syncRoles(User $user, array $roles): void
    {
        $roleNames = array_map(function($roleId) {
            return Role::find($roleId)->name ?? null;
        }, $roles);

        $user->syncRoles(array_filter($roleNames));
    }
}
