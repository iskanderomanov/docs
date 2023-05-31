<?php

namespace App\Http\Controllers\Web\Hr;

use App\Http\Dto\Position\EditPositionDto;
use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\User\EditUserDto;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Responses\ResponseBuilder;
use App\Services\User\Interfaces\UserServiceInterface;
use App\Utils\RouteNames;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

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

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view(self::PATH_VIEW . self::USER_VIEW . self::FORM_VIEW);
    }

    public function update()
    {

    }

    public function edit(int $id)
    {
        $response = $this->userService->edit(new EditUserDto(['id' => $id]));

        return view(self::PATH_VIEW . self::USER_VIEW . self::FORM_VIEW, $response->isFailed() ? [] : $response->getResult());
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $this->userService->create(new CreateUserDto($request->toArray()));
        return ResponseBuilder::jsonRedirect(route(RouteNames::USER_INDEX));
    }
}
