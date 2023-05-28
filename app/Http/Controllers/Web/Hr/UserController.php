<?php

namespace App\Http\Controllers\Web\Hr;

use App\Services\User\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends HrBaseController
{
    public const USER_VIEW = 'users.';
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $adminService
     */
    public function __construct(
        UserServiceInterface $adminService
    )
    {
        $this->userService = $adminService;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $response = $this->userService->index();
        return view(self::PATH_VIEW . self::USER_VIEW . self::INDEX_VIEW, $response->getResult());
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function edit()
    {

    }

    public function store()
    {

    }
}
