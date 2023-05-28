<?php

namespace App\Repositories\Position\Interfaces;

use App\Http\Dto\Position\BaseEditPositionDto;

interface PositionRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll(): mixed;

    public function find(BaseEditPositionDto $dto);
}
