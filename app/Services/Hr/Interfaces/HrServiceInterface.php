<?php

namespace App\Services\Hr\Interfaces;

use App\Http\Dto\Hr\BaseCreateHrDto;
use App\Services\ServiceResponse;

interface HrServiceInterface
{
    public function createAdmin(BaseCreateHrDto $dto): ServiceResponse;
}
