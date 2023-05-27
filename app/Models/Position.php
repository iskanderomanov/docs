<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends BaseModel
{
    use HasFactory;

    /**
     * Здесь описываются название колонок в таблице
     *  Название доступа
     */
    public const NAME_COLUMN = 'name';

    /**
     *  Название 'разрешение роли'
     */
    public const POSITION_ID_COLUMN = 'position_id';

    protected $fillable = [self::NAME_COLUMN];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, self::POSITION_ID_COLUMN);
    }
}
