<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\BaseWebController;
use App\Http\Dto\Auth\AuthLoginDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\ResponseBuilder;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseWebController
{
    public final const VIEW_PATH = 'auth.';

    /**
     * @var AuthServiceInterface
     */
    private AuthServiceInterface $authService;

    /**
     * @param AuthServiceInterface $authService
     */
    public function __construct(
        AuthServiceInterface $authService
    )
    {
        $this->authService = $authService;
    }

    /**
     * @return Factory|View|Application
     */
    public function getLoginPage(): Factory|View|Application
    {
        return view(self::VIEW_PATH . 'login');
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function postLogin(LoginRequest $request): JsonResponse
    {
        $response = $this->authService->webLogin(new AuthLoginDto($request->toArray()));

        if($response->isFailed()){
            return ResponseBuilder::jsonAlertError('Ошибка', 'Логин или пароль не верные', 401);
        }

        return ResponseBuilder::jsonRedirect($response->getResult());
    }
}
