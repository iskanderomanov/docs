<?php

namespace App\Repositories\Department\Interfaces;

use App\Http\Dto\Department\BaseEditDepartmentDto;

interface DepartmentRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll(): mixed;

    public function find(BaseEditDepartmentDto $dto);
}
