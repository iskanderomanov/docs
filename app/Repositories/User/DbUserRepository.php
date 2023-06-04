<?php

namespace App\Repositories\User;

use App\Http\Dto\User\BaseEditUserDto;
use App\Http\Dto\User\BaseGetUserDto;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DbUserRepository implements UserRepositoryInterface
{
    /**
     * @param BaseGetUserDto $dto
     * @return object|null
     */
    public function getByEmail(BaseGetUserDto $dto): object|null
    {
        return User::query()->where(User::EMAIL_COLUMN,$dto->email)->first();
    }

    /**
     * @param BaseEditUserDto $dto
     * @return object|null
     */
    public function getForEdit(BaseEditUserDto $dto): object|null
    {
        return User::query()->where('id',$dto->id)->with('rates')->first();
    }

    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return User::query()->orderBy('id')->with('department')->get();
    }

    /**
     * @param int $departmentId
     * @return Collection|array
     */
    public function getUsersByDepartmentId(int $departmentId): Collection|array
    {
        return User::query()->where('department_id', $departmentId)->orderBy('id')->with('department')->get();
    }

    /**
     * @param int $departmentId
     * @return Collection
     */
    public function getTimeKeeperByDepartmentId(int $departmentId)
    {
        return User::where('department_id', $departmentId)
            ->where('is_time_keeper', true)
            ->first();
    }

}
