<?php

namespace App\Repositories\User\Interfaces;

use App\Http\Dto\User\BaseGetUserDto;

interface UserRepositoryInterface
{
    public function getByEmail(BaseGetUserDto $dto);
    public function getAll();
}
