<?php

namespace App\Repositories\User\Interfaces;

use App\Http\Dto\User\BaseEditUserDto;
use App\Http\Dto\User\BaseGetUserDto;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getByEmail(BaseGetUserDto $dto);
    public function getAll();

    public function getUsersByDepartmentId(int $departmentId): Collection|array;

    public function getTimeKeeperByDepartmentId(int $departmentId);

    public function getForEdit(BaseEditUserDto $dto): object|null;

}
