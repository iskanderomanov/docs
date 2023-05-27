<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rate extends BaseModel
{
    use HasFactory;

    /**
     * Здесь описываются название колонок в таблице
     *  Название колонки для идентификатора пользователя
     */
    public const USER_ID_COLUMN = 'user_id';
    /**
     *  Название колонки для дневной ставки
     */
    public const RATE_COLUMN = 'rate';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::USER_ID_COLUMN,
        self::RATE_COLUMN
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, self::USER_ID_COLUMN);
    }
}
