<?php

namespace App\Http\Dto\Department;

abstract class BaseCreateDepartmentDto extends BaseDepartmentDto
{
    /**
     * @var string
     */
    public string $name;
}
