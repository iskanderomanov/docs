<?php

namespace App\Repositories\User\Interfaces;

use App\Http\Dto\Hr\BaseGetHrDto;

interface UserRepositoryInterface
{
    public function getByEmail(BaseGetHrDto $dto);
    public function getAll();
}
