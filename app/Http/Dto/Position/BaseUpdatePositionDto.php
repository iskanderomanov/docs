<?php

namespace App\Http\Dto\Position;

abstract class BaseUpdatePositionDto extends BasePositionDto
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
