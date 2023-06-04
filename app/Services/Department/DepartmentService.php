<?php

namespace App\Services\Department;

use App\Http\Dto\Department\BaseCreateDepartmentDto;
use App\Http\Dto\Department\BaseEditDepartmentDto;
use App\Http\Dto\Department\BaseUpdateDepartmentDto;
use App\Models\Department;
use App\Repositories\Department\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Department\DepartmentRepositoryFactory;
use App\Services\Department\Interfaces\DepartmentServiceInterface;
use App\Services\Service;
use App\Services\ServiceError;
use App\Services\ServiceResponse;
use Exception;

class DepartmentService extends Service implements DepartmentServiceInterface
{
    public const DEPARTMENTS = 'departments';
    public const DEPARTMENT = 'department';
    /**
     * @var DepartmentRepositoryInterface
     */
    private DepartmentRepositoryInterface $departmentRepository;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->departmentRepository = (new DepartmentRepositoryFactory())->createRepository();
    }

    /**
     * @return ServiceResponse
     */
    public function index(): ServiceResponse
    {
        $departments = $this->departmentRepository->getAll();

        return new ServiceResponse([
            self::DEPARTMENTS => $departments
        ]);
    }


    /**
     * @param BaseCreateDepartmentDto $dto
     * @return ServiceResponse
     */
    public function store(BaseCreateDepartmentDto $dto): ServiceResponse
    {
        return new ServiceResponse(Department::createDepartment($dto));
    }

    /**
     * @param BaseEditDepartmentDto $dto
     * @return ServiceResponse
     */
    public function edit(BaseEditDepartmentDto $dto): ServiceResponse
    {
        try {
            $department = $this->departmentRepository->find($dto);
        } catch (Exception $e) {
            $this->addError(new ServiceError($e->getMessage(), $e->getCode()));
            return $this->createResponse();
        }

        return $this->createResponse([self::DEPARTMENT => $department]);
    }


    /**
     * @param BaseUpdateDepartmentDto $dto
     * @return ServiceResponse
     */
    public function update(BaseUpdateDepartmentDto $dto): ServiceResponse
    {
        Department::updateDepartment($dto);
        return $this->createResponse(true);
    }
}
