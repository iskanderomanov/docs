<?php

namespace App\Repositories\User;

use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Exception;

class UserRepositoryFactory
{
    /**
     * @param string $type
     * @return UserRepositoryInterface
     * @throws Exception
     */
    public function createRepository(string $type = DbUserRepository::class): UserRepositoryInterface
    {
        return match ($type) {
            DbUserRepository::class => new DbUserRepository(),
            default => throw new Exception('Repository type not found'),
        };
    }
}
