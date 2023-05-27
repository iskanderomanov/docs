<?php

namespace App\Repositories\Admin;

use App\Http\Dto\Hr\BaseGetHrDto;
use App\Models\User;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;

class DbAdminRepository implements AdminRepositoryInterface
{
    /**
     * @param BaseGetHrDto $dto
     * @return object|null
     */
    public function getByEmail(BaseGetHrDto $dto): object|null
    {
        return User::query()->where(User::EMAIL_COLUMN,$dto->email)->first();
    }
}
