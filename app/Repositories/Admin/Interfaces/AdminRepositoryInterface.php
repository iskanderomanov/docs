<?php

namespace App\Repositories\Admin\Interfaces;

use App\Http\Dto\Hr\BaseGetHrDto;

interface AdminRepositoryInterface
{
    public function getByEmail(BaseGetHrDto $dto);
}
