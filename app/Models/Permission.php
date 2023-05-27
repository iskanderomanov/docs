<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends BaseModel
{
    use HasFactory;

    /**
     * Здесь описываются название колонок в таблице
     *  Название доступа
     */
    public const NAME_COLUMN = 'name';
    protected $fillable = [self::NAME_COLUMN ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
