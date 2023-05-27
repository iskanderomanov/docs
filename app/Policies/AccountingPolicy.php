<?php

namespace App\Policies;

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountingPolicy
{
    use HandlesAuthorization;

    const ACCOUNTING_NAME = 'Бухгалтерия';

    public function view(User $user)
    {
        return $user->role->name === self::ACCOUNTING_NAME;
    }

    public function create(User $user)
    {
        return $user->role->name === self::ACCOUNTING_NAME;
    }

    public function update(User $user)
    {
        return $user->role->name === self::ACCOUNTING_NAME;
    }

    public function delete(User $user)
    {
        return $user->role->name === self::ACCOUNTING_NAME;
    }
}

