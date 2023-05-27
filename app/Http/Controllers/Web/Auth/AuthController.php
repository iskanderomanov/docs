<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseWebController;
use App\Http\Dto\Auth\AuthLoginDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthController extends BaseWebController
{
    public final const VIEW_PATH = 'auth.';

    private AuthServiceInterface $authService;
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

    public function postLogin(LoginRequest $request)
    {
        $response = $this->authService->login(new AuthLoginDto($request->toArray()));

    }
}
