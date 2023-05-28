<?php

namespace App\Services\Position;

use App\Http\Dto\Position\BaseCreatePositionDto;
use App\Http\Dto\Position\BaseEditPositionDto;
use App\Http\Dto\Position\BaseUpdatePositionDto;
use App\Models\Position;
use App\Repositories\Position\Interfaces\PositionRepositoryInterface;
use App\Repositories\Position\PositionRepositoryFactory;
use App\Services\Position\Interfaces\PositionServiceInterface;
use App\Services\Service;
use App\Services\ServiceError;
use App\Services\ServiceResponse;
use Exception;

class PositionService extends Service implements PositionServiceInterface
{
    public const POSITIONS = 'positions';
    public const POSITION = 'position';
    /**
     * @var PositionRepositoryInterface
     */
    private PositionRepositoryInterface $positionRepository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->positionRepository = (new PositionRepositoryFactory())->createRepository();
    }

    /**
     * @return ServiceResponse
     */
    public function index(): ServiceResponse
    {
        $positions = $this->positionRepository->getAll();

        return new ServiceResponse([
            self::POSITIONS => $positions
        ]);
    }


    /**
     * @param BaseCreatePositionDto $dto
     * @return ServiceResponse
     */
    public function store(BaseCreatePositionDto $dto): ServiceResponse
    {
        return new ServiceResponse(Position::createPosition($dto));
    }

    /**
     * @param BaseEditPositionDto $dto
     * @return ServiceResponse
     */
    public function edit(BaseEditPositionDto $dto): ServiceResponse
    {
        try {
            $position = $this->positionRepository->find($dto);
        } catch (Exception $e) {
            $this->addError(new ServiceError($e->getMessage(), $e->getCode()));
            return $this->createResponse();
        }

        return $this->createResponse([self::POSITION => $position]);
    }


    /**
     * @param BaseUpdatePositionDto $dto
     * @return ServiceResponse
     */
    public function update(BaseUpdatePositionDto $dto): ServiceResponse
    {
        Position::updatePosition($dto);
        return $this->createResponse(true);
    }
}
