<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
namespace App\Policies;

class HRPolicy
{
    use HandlesAuthorization;

    const HR_NAME = 'Отдел кадров';

    public function view(User $user)
    {
        return $user->role->name === self::HR_NAME;
    }

    public function create(User $user)
    {
        return $user->role->name === self::HR_NAME;
    }

    public function update(User $user)
    {
        return $user->role->name === self::HR_NAME;
    }

    public function delete(User $user)
    {
        return $user->role->name === self::HR_NAME;
    }
}

