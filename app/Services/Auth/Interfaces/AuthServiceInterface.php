<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Dto\Auth\BaseLoginAuthDto;
use App\Services\ServiceResponse;

interface AuthServiceInterface
{
    public function webLogin(BaseLoginAuthDto $dto): ServiceResponse;
}
