<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TabelPolicy
{
    use HandlesAuthorization;

    const TABEL_NAME = 'Табельщик';

    public function view(User $user)
    {
        return $user->role->name === self::TABEL_NAME;
    }

    public function create(User $user)
    {
        return $user->role->name === self::TABEL_NAME;
    }

    public function update(User $user)
    {
        return $user->role->name === self::TABEL_NAME;
    }

    public function delete(User $user)
    {
        return $user->role->name === self::TABEL_NAME;
    }
}
