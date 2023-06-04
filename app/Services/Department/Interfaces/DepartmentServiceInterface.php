<?php

namespace App\Services\Department\Interfaces;

use App\Http\Dto\Department\BaseCreateDepartmentDto;
use App\Http\Dto\Department\BaseEditDepartmentDto;
use App\Http\Dto\Department\BaseUpdateDepartmentDto;
use App\Services\ServiceResponse;

interface DepartmentServiceInterface
{
    /**
     * @return ServiceResponse
     */
    public function index(): ServiceResponse;

    public function edit(BaseEditDepartmentDto $dto): ServiceResponse;

    public function update(BaseUpdateDepartmentDto $dto): ServiceResponse;

    public function store(BaseCreateDepartmentDto $dto): ServiceResponse;
}
