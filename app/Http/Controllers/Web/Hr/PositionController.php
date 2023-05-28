<?php

namespace App\Http\Controllers\Web\Hr;

use App\Http\Dto\Position\CreatePositionDto;
use App\Http\Dto\Position\EditPositionDto;
use App\Http\Dto\Position\UpdatePositionDto;
use App\Http\Requests\Position\CreatePositionRequest;
use App\Http\Requests\Position\UpdatePositionRequest;
use App\Http\Responses\ResponseBuilder;
use App\Services\Position\Interfaces\PositionServiceInterface;
use App\Utils\RouteNames;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PositionController extends HrBaseController
{
    /**
     * @var PositionServiceInterface
     */
    private PositionServiceInterface $positionService;

    /**
     * @param PositionServiceInterface $positionService
     */
    public function __construct(
        PositionServiceInterface $positionService
    )
    {
        $this->positionService = $positionService;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $response = $this->positionService->index();
        return view(self::PATH_VIEW . self::POSITION_VIEW . self::INDEX_VIEW, $response->getResult());
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view(self::PATH_VIEW . self::POSITION_VIEW . self::FORM_VIEW);
    }

    /**
     * @param CreatePositionRequest $request
     * @return JsonResponse
     */
    public function store(CreatePositionRequest $request): JsonResponse
    {
        $this->positionService->store(new CreatePositionDto($request->toArray()));
        return ResponseBuilder::jsonRedirect(route(RouteNames::POSITION_INDEX));
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $response = $this->positionService->edit(new EditPositionDto(['id' => $id]));

        return view(self::PATH_VIEW . self::POSITION_VIEW . self::FORM_VIEW, $response->isFailed() ? [] : $response->getResult());
    }

    /**
     * @param int $id
     * @param UpdatePositionRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdatePositionRequest $request): JsonResponse
    {
        $this->positionService->update(new UpdatePositionDto(['id' => $id, ...$request->toArray()]));
        return ResponseBuilder::jsonRedirect(route(RouteNames::POSITION_INDEX));
    }
}
