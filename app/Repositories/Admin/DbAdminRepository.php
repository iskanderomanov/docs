<?php

namespace App\Repositories\Admin;

use App\Http\Dto\Admin\BaseGetAdminDto;
use App\Models\User;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;

class DbAdminRepository implements AdminRepositoryInterface
{
    /**
     * @param BaseGetAdminDto $dto
     * @return object|null
     */
    public function getByEmail(BaseGetAdminDto $dto): object|null
    {
        return User::query()->where(User::EMAIL_COLUMN,$dto->email)->first();
    }
}
