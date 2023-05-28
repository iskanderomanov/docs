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
     * Метод входа для веба
     *
     * @param BaseLoginAuthDto $dto
     * @return ServiceResponse
     */
    public function webLogin(BaseLoginAuthDto $dto): ServiceResponse
    {
        if (!$this->login($dto)) {
            $this->addError(new ServiceError('Неверные учётные данные', 422));
            return $this->createResponse();
        }

        return new ServiceResponse(route(Auth::user()->getMainRouteName()));
    }

    private function login(BaseLoginAuthDto $dto): bool
    {
        if (Auth::attempt($dto->toArray())) {
            return true;
        }

        return false;
    }
}
