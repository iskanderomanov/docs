<?php

namespace App\Repositories\User;

use App\Http\Dto\User\BaseEditUserDto;
use App\Http\Dto\User\BaseGetUserDto;
use App\Http\Enums\RateTypes;
use App\Http\Enums\UserTypes;
use App\Models\Rate;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Cassandra\Type\UserType;
use Illuminate\Database\Eloquent\Collection;

class DbUserRepository implements UserRepositoryInterface
{
    /**
     * @param BaseGetUserDto $dto
     * @return object|null
     */
    public function getByEmail(BaseGetUserDto $dto): object|null
    {
        return User::query()->where(User::EMAIL_COLUMN, $dto->email)->first();
    }

    /**
     * @param BaseEditUserDto $dto
     * @return object|null
     */
    public function getForEdit(BaseEditUserDto $dto): object|null
    {
        return User::query()->where('id', $dto->id)->with('rates')->first();
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
     * @return mixed
     */
    public function getTimeKeeperByDepartmentId(int $departmentId): mixed
    {
        return User::where('department_id', $departmentId)
            ->where('is_time_keeper', true)
            ->first();
    }

    /**
     * @param int $departmentId
     * @return Collection|array
     */
    public function getRegularTeachers(int $departmentId): Collection|array
    {
        return User::query()->where(User::DEPARTMENT_ID_COLUMN, $departmentId)
            ->where(User::USER_TYPE_COLUMN, UserTypes::TEACHER_TYPE->value)
            ->where(User::IS_IN_STATE, true)
            ->with(['position', 'rates' => function ($query) {
                $query->where('rate_type', RateTypes::getRateId(RateTypes::MAIN->value));
            }])
            ->get();
    }

    /**
     * @param int $departmentId
     * @return Collection|array
     */
    public function getAdditionalTeachers(int $departmentId): Collection|array
    {
        return User::query()->where(User::DEPARTMENT_ID_COLUMN, $departmentId)
            ->where(User::USER_TYPE_COLUMN, UserTypes::TEACHER_TYPE->value)
            ->where(User::IS_IN_STATE, true)
            ->with(['position', 'rates' => function ($query) {
                $query->where('rate_type', RateTypes::getRateId(RateTypes::ADDITIONAL->value));
            }])
            ->get();
    }

    public function getHiredTeachers(int $departmentId): Collection|array
    {
        return User::query()->where(User::DEPARTMENT_ID_COLUMN, $departmentId)
            ->where(User::USER_TYPE_COLUMN, UserTypes::TEACHER_TYPE->value)
            ->where(User::IS_IN_STATE, false)
            ->with(['position', 'rates' => function ($query) {
                $query->where('rate_type', RateTypes::getRateId(RateTypes::HIRED->value));
            }])
            ->get();
    }
}
