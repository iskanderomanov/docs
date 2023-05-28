<?php

namespace App\Repositories\Position;

use App\Repositories\Position\Interfaces\PositionRepositoryInterface;
use Exception;

class PositionRepositoryFactory
{
    /**
     * @param string $type
     * @return PositionRepositoryInterface
     * @throws Exception
     */
    public function createRepository(string $type = DbPositionRepository::class): PositionRepositoryInterface
    {
        return match ($type) {
            DbPositionRepository::class => new DbPositionRepository(),
            default => throw new Exception('Repository type not found'),
        };
    }
}
