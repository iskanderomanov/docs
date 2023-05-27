<?php

namespace App\Services\Admin;

use App\Http\Dto\Admin\BaseCreateAdminDto;
use App\Http\Dto\Admin\GetAdminDto;
use App\Models\User;
use App\Repositories\Admin\AdminRepositoryFactory;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Services\Admin\Interfaces\AdminServiceInterface;
use App\Services\Service;
use App\Services\ServiceResponse;
use Exception;

class AdminService extends Service implements AdminServiceInterface
{
    private AdminRepositoryInterface $repository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->repository = (new AdminRepositoryFactory())->createRepository();
    }

    /**
     * @param BaseCreateAdminDto $dto
     * @return ServiceResponse
     */
    public function createAdmin(BaseCreateAdminDto $dto): ServiceResponse
    {
        $user = $this->repository->getByEmail(new GetAdminDto($dto->toArray()));

        if(!is_null($user)){
            return $this->createResponse(false);
        }

        $user = User::createAdmin($dto);
        return $this->createResponse($user);
    }
}
