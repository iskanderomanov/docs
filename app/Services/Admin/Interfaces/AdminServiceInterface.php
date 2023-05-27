<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Dto\Admin\BaseCreateAdminDto;
use App\Services\ServiceResponse;

interface AdminServiceInterface
{
    public function createAdmin(BaseCreateAdminDto $dto): ServiceResponse;
}
