<?php

namespace App\Repositories\Department;

use App\Http\Dto\Department\BaseEditDepartmentDto;
use App\Models\Department;
use App\Repositories\Department\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DbDepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return Department::query()->orderBy(Department::ID_COLUMN)->get();
    }

    /**
     * @param BaseEditDepartmentDto $dto
     * @return Department
     */
    public function find(BaseEditDepartmentDto $dto): Department
    {
        return Department::findOrFail($dto->id);
    }
}
