<?php

namespace App\Repositories\Admin;

use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use Exception;

class AdminRepositoryFactory
{
    /**
     * @param string $type
     * @return AdminRepositoryInterface
     * @throws Exception
     */
    public function createRepository(string $type = DbAdminRepository::class): AdminRepositoryInterface
    {
        return match ($type) {
            DbAdminRepository::class => new DbAdminRepository(),
            default => throw new Exception('Repository type not found'),
        };
    }
}
