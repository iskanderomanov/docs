<?php

namespace App\Services\User;

use App\Http\Dto\User\BaseCreateUserDto;
use App\Http\Dto\User\BaseEditUserDto;
use App\Http\Dto\User\BaseUpdateUserDto;
use App\Http\Dto\User\GetUserDto;
use App\Models\User;
use App\Repositories\Department\DepartmentRepositoryFactory;
use App\Repositories\Department\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Position\Interfaces\PositionRepositoryInterface;
use App\Repositories\Position\PositionRepositoryFactory;
use App\Repositories\User\UserRepositoryFactory;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Services\Department\DepartmentService;
use App\Services\Position\Interfaces\PositionServiceInterface;
use App\Services\Position\PositionService;
use App\Services\ServiceError;
use App\Services\User\Interfaces\UserServiceInterface;
use App\Services\Service;
use App\Services\ServiceResponse;
use Exception;

class UserService extends Service implements UserServiceInterface
{
    public const USERS = 'users';
    public const USER = 'user';
    private UserRepositoryInterface $repository;

    private PositionRepositoryInterface $positionRepository;
    private DepartmentRepositoryInterface $departmentRepository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->repository = (new UserRepositoryFactory())->createRepository();
        $this->positionRepository = (new PositionRepositoryFactory())->createRepository();
        $this->departmentRepository = (new DepartmentRepositoryFactory())->createRepository();
    }

    /**
     * @param BaseCreateUserDto $dto
     * @return ServiceResponse
     */
    public function store(BaseCreateUserDto $dto): ServiceResponse
    {
        $user = $this->repository->getByEmail(new GetUserDto($dto->toArray()));

        if (!is_null($user)) {
            return $this->createResponse(false);
        }

        if (isset($dto->is_time_keeper) && $this->repository->getTimeKeeperByDepartmentId($dto->department_id)) {
            $this->addError(new ServiceError('Уже существует табельщик в этой кафедре'));
            return $this->createResponse();
        }
        $user = User::create($dto);

        if (isset($dto->rate['additional']) && isset($dto->rate['hired'])) {
            User::createRates($dto->rate, $user->id);
        }
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
        return $this->createResponse([
            self::USER => $this->repository->getForEdit($dto),
            PositionService::POSITIONS => $this->positionRepository->getAll(),
            DepartmentService::DEPARTMENTS => $this->departmentRepository->getAll()
        ]);
    }

    public function update(BaseUpdateUserDto $dto): ServiceResponse
    {

        if ($dto->is_time_keeper && $this->repository->getTimeKeeperByDepartmentId($dto->department_id)) {
            $this->addError(new ServiceError('Уже существует табельщик в этой кафедре'));
            return $this->createResponse();
        }
        $user = User::updateUser($dto);

        if (isset($dto->rate['additional']) || isset($dto->rate['hired'])) {
            User::updateRates($dto->rate, $dto->id);
        }
        return $this->createResponse($user);
    }

    public function getCreate(): ServiceResponse
    {
        return $this->createResponse([
            PositionService::POSITIONS => $this->positionRepository->getAll(),
            DepartmentService::DEPARTMENTS => $this->departmentRepository->getAll()
        ]);
    }

}
