<?php

namespace App\Services\User;

use App\Http\Dto\User\BaseCreateUserDto;
use App\Http\Dto\User\BaseEditUserDto;
use App\Http\Dto\User\GetUserDto;
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
     * @param BaseCreateUserDto $dto
     * @return ServiceResponse
     */
    public function create(BaseCreateUserDto $dto): ServiceResponse
    {
        $user = $this->repository->getByEmail(new GetUserDto($dto->toArray()));

        if(!is_null($user)){
            return $this->createResponse(false);
        }

        $user = User::createAdmin($dto);
        return $this->createResponse($user);
    }

    /**
     * @return ServiceResponse
     */
    public function index(): ServiceResponse
    {
        return $this->createResponse([
            self::USERS => $this->repository->getAll()
        ]);
    }

    public function edit(BaseEditUserDto $dto): ServiceResponse
    {

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
