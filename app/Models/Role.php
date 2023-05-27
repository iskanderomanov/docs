<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends BaseModel
{
    use HasFactory;

    /**
     * Здесь описываются название колонок в таблице
     *  'Название роли'
     */
    public const NAME_COLUMN = 'name';

    /**
     *  Название 'разрешение роли'
     */
    public const ROLE_PERMISSION_COLUMN = 'role_permission';

    /**
     * @var string[]
     */
    protected $fillable = [self::NAME_COLUMN];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, self::ROLE_PERMISSION_COLUMN);
    }
}
