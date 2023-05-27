<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Название колонки в таблице для хранения имени пользователя.
     *
     * @var string
     */
    public const NAME_COLUMN = 'name';

    /**
     * Название колонки в таблице для хранения электронной почты пользователя.
     *
     * @var string
     */
    public const EMAIL_COLUMN = 'email';

    /**
     * Название колонки в таблице для хранения пароля пользователя.
     *
     * @var string
     */
    public const PASSWORD_COLUMN = 'password';

    /**
     * Название колонки в таблице для хранения типа пользователя.
     *
     * @var string
     */
    public const USER_TYPE_COLUMN = 'user_type';

    /**
     * Название колонки в таблице для хранения информации о том, является ли пользователь администратором.
     *
     * @var string
     */
    public const IS_ADMIN_COLUMN = 'is_admin';

    /**
     * Название колонки в таблице для хранения идентификатора должности пользователя.
     *
     * @var string
     */
    public const POSITION_ID_COLUMN = 'position_id';

    /**
     * Атрибуты, которые массово назначаемые.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::PASSWORD_COLUMN,
        self::USER_TYPE_COLUMN,
        self::IS_ADMIN_COLUMN,
        self::POSITION_ID_COLUMN
    ];

    /**
     * Атрибуты, которые должны быть скрыты при сериализации.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD_COLUMN
    ];

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return HasOne
     */
    public function position(): HasOne
    {
        return $this->hasOne(Position::class, self::POSITION_ID_COLUMN);
    }
}
