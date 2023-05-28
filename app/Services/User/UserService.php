<?php

namespace App\Services\User;

use App\Http\Dto\Hr\BaseCreateHrDto;
use App\Http\Dto\Hr\GetHrDto;
use App\Models\User;
use App\Repositories\User\UserRepositoryFactory;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\UserServiceInterface;
use App\Services\Service;
use App\Services\ServiceResponse;
use Exception;

class UserService extends Service implements UserServiceInterface
{
    public const USERS = 'users';
    private UserRepositoryInterface $repository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->repository = (new UserRepositoryFactory())->createRepository();
    }

    /**
     * @param BaseCreateHrDto $dto
     * @return ServiceResponse
     */
    public function create(BaseCreateHrDto $dto): ServiceResponse
    {
        $user = $this->repository->getByEmail(new GetHrDto($dto->toArray()));

        if(!is_null($user)){
            return $this->createResponse(false);
        }

        $user = User::createAdmin($dto);
        return $this->createResponse($user);
    }

    public function index(): ServiceResponse
    {
        return $this->createResponse([
            self::USERS => $this->repository->getAll()
        ]);
    }

    public function edit(): ServiceResponse
    {
        // TODO: Implement edit() method.
    }

    public function update(): ServiceResponse
    {
        // TODO: Implement update() method.
    }

    public function store(): ServiceResponse
    {
        // TODO: Implement store() method.
    }
}
