<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Dto\Hr\BaseCreateHrDto;
use App\Http\Enums\UserTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    #todo админа в отдельный класс вынести.

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
     * @return HasOne
     */
    public function position(): HasOne
    {
        return $this->hasOne(Position::class, self::POSITION_ID_COLUMN);
    }

    /**
     * Является ОК
     *
     * @return bool
     */
    public function isHr(): bool
    {
        return $this->user_type === UserTypes::HR_TYPE;
    }

    /**
     * Является бухгалтером
     *
     * @return bool
     */
    public function isAccounting(): bool
    {
        return $this->user_type === UserTypes::ACCOUNTING_TYPE;
    }

    /**
     * Является табельщиком
     *
     * @return bool
     */
    public function isTimeKeeper(): bool
    {
        return $this->user_type === UserTypes::TIME_KEEPER_TYPE;
    }

    /**
     * @param BaseCreateHrDto $dto
     * @return bool
     */
    public static function createAdmin(BaseCreateHrDto $dto): bool
    {
        return (new User($dto->toArray()))->save();
    }

    /**
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes[self::PASSWORD_COLUMN] = Hash::make($value);
    }
}
