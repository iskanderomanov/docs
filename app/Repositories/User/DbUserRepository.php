<?php

namespace App\Repositories\User;

use App\Http\Dto\Hr\BaseGetHrDto;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DbUserRepository implements UserRepositoryInterface
{
    /**
     * @param BaseGetHrDto $dto
     * @return object|null
     */
    public function getByEmail(BaseGetHrDto $dto): object|null
    {
        return User::query()->where(User::EMAIL_COLUMN,$dto->email)->first();
    }

    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return User::query()->orderBy('id')->with('position')->get();
    }
}
