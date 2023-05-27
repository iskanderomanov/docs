<?php

namespace App\Services\Auth;

use App\Http\Dto\Auth\BaseLoginAuthDto;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use App\Services\Service;
use App\Services\ServiceError;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Auth;

class AuthService extends Service implements AuthServiceInterface
{
    /**
     * Метод входа
     *
     * @param BaseLoginAuthDto $dto
     * @return ServiceResponse
     */
    public function login(BaseLoginAuthDto $dto): ServiceResponse
    {
        if (Auth::attempt($dto->toArray())) {
            return $this->createResponse(true);
        }

        $this->addError(new ServiceError('Неверные учётные данные',422));
        return $this->createResponse(false);
    }
}
