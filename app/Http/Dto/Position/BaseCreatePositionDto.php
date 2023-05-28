<?php

namespace App\Http\Dto\Position;

abstract class BaseCreatePositionDto extends BasePositionDto
{
    /**
     * @var string
     */
    public string $name;
}
