<?php

namespace App\Http\Dto\Department;

abstract class BaseUpdateDepartmentDto extends BaseDepartmentDto
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $name;
}
