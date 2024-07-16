<?php

namespace App\Http\Services;

use App\Models\UserRole;

class UserService
{
    public function createUserRole($userId, $roleId)
    {

        UserRole::create([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);
    }

}
