<?php

namespace App\Repositories\Department;

use App\Repositories\Department\Interfaces\DepartmentRepositoryInterface;
use Exception;

class DepartmentRepositoryFactory
{
    /**
     * @param string $type
     * @return DepartmentRepositoryInterface
     * @throws Exception
     */
    public function createRepository(string $type = DbDepartmentRepository::class): DepartmentRepositoryInterface
    {
        return match ($type) {
            DbDepartmentRepository::class => new DbDepartmentRepository(),
            default => throw new Exception('Repository type not found'),
        };
    }
}
