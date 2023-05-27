<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
    /**
     * Здесь описываются название промежуточной таблицы
     *
     */
    public const TABLE_NAME = 'role_permission';

    protected $table = self::TABLE_NAME;

}
