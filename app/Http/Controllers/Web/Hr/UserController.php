<?php

namespace App\Http\Controllers\Web\Hr;

use App\Http\Dto\Position\EditPositionDto;
use App\Http\Dto\User\CreateUserDto;
use App\Http\Dto\User\EditUserDto;
use App\Http\Dto\User\UpdateUserDto;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Responses\ResponseBuilder;
use App\Models\Position;
use App\Repositories\Position\PositionRepositoryFactory;
use App\Services\Position\Interfaces\PositionServiceInterface;
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
     * @var PositionServiceInterface
     */
    private PositionServiceInterface $positionService;

    /**
     * @param UserServiceInterface $adminService
     */
    public function __construct(
        UserServiceInterface     $adminService,
        PositionServiceInterface $positionService,
    )
    {
        $this->userService = $adminService;
        $this->positionService = $positionService;
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
        $position = $this->userService->getCreate();

        return view(self::PATH_VIEW . self::USER_VIEW . self::FORM_VIEW, $position->getResult());
    }

    public function update(int $id,UpdateUserRequest $request)
    {
        $response = $this->userService->update(new UpdateUserDto(['id' => $id, ...$request->toArray()]));

        if($response->isFailed()){
            return ResponseBuilder::jsonAlertError('Ошибка', $response->getServiceErrors()[0]->getMessage(), 409);
        }
        return ResponseBuilder::jsonRedirect(route(RouteNames::USER_INDEX));
    }

    public function edit(int $id)
    {
        $response = $this->userService->edit(new EditUserDto(['id' => $id]));

        return view(self::PATH_VIEW . self::USER_VIEW . self::FORM_VIEW, $response->isFailed() ? [] : $response->getResult());
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $response = $this->userService->store(new CreateUserDto($request->toArray()));

        if($response->isFailed()){
            return ResponseBuilder::jsonAlertError('Ошибка', $response->getServiceErrors()[0]->getMessage(), 409);
        }
        return ResponseBuilder::jsonRedirect(route(RouteNames::USER_INDEX));
    }
}
