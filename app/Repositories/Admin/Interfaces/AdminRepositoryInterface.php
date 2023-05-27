<?php

namespace App\Repositories\Admin\Interfaces;

use App\Http\Dto\Admin\BaseGetAdminDto;

interface AdminRepositoryInterface
{
    public function getByEmail(BaseGetAdminDto $dto);
}
