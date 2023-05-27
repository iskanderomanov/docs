<?php

namespace App\Services\Hr;

use App\Http\Dto\Hr\BaseCreateHrDto;
use App\Http\Dto\Hr\GetHrDto;
use App\Models\User;
use App\Repositories\Admin\AdminRepositoryFactory;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Services\Hr\Interfaces\HrServiceInterface;
use App\Services\Service;
use App\Services\ServiceResponse;
use Exception;

class HrService extends Service implements HrServiceInterface
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
     * @param BaseCreateHrDto $dto
     * @return ServiceResponse
     */
    public function createAdmin(BaseCreateHrDto $dto): ServiceResponse
    {
        $user = $this->repository->getByEmail(new GetHrDto($dto->toArray()));

        if(!is_null($user)){
            return $this->createResponse(false);
        }

        $user = User::createAdmin($dto);
        return $this->createResponse($user);
    }
}
