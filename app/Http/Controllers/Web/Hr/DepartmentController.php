<?php

namespace App\Http\Controllers\Web\Hr;

use App\Http\Dto\Department\CreateDepartmentDto;
use App\Http\Dto\Department\EditDepartmentDto;
use App\Http\Dto\Department\UpdateDepartmentDto;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Responses\ResponseBuilder;
use App\Services\Department\Interfaces\DepartmentServiceInterface;
use App\Utils\RouteNames;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class DepartmentController extends HrBaseController
{
    /**
     * @var DepartmentServiceInterface
     */
    private DepartmentServiceInterface $departmentService;

    /**
     * @param DepartmentServiceInterface $departmentService
     */
    public function __construct(
        DepartmentServiceInterface $departmentService
    )
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $response = $this->departmentService->index();
        return view(self::PATH_VIEW . self::DEPARTMENT_VIEW . self::INDEX_VIEW, $response->getResult());
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view(self::PATH_VIEW . self::DEPARTMENT_VIEW . self::FORM_VIEW);
    }

    /**
     * @param CreateDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(CreateDepartmentRequest $request): JsonResponse
    {
        $this->departmentService->store(new CreateDepartmentDto($request->toArray()));
        return ResponseBuilder::jsonRedirect(route(RouteNames::DEPARTMENT_INDEX));
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $response = $this->departmentService->edit(new EditDepartmentDto(['id' => $id]));

        return view(self::PATH_VIEW . self::DEPARTMENT_VIEW . self::FORM_VIEW, $response->isFailed() ? [] : $response->getResult());
    }

    /**
     * @param int $id
     * @param UpdateDepartmentRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateDepartmentRequest $request): JsonResponse
    {
        $this->departmentService->update(new UpdateDepartmentDto(['id' => $id, ...$request->toArray()]));
        return ResponseBuilder::jsonRedirect(route(RouteNames::DEPARTMENT_INDEX));
    }
}
