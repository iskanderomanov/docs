<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Dto\User\BaseCreateUserDto;
use App\Http\Enums\UserTypes;
use App\Utils\RouteNames;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $is_time_keeper
 * @property int $position_id
 * @property int $user_type
 */
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
    public const IS_TIME_KEEPER_COLUMN = 'is_time_keeper';

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
        self::IS_TIME_KEEPER_COLUMN,
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
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, self::POSITION_ID_COLUMN);
    }

    /**
     * Является ОК
     *
     * @return bool
     */
    public function isHr(): bool
    {
        return $this->user_type === UserTypes::HR_TYPE->value;
    }

    /**
     * Является бухгалтером
     *
     * @return bool
     */
    public function isAccounting(): bool
    {
        return $this->user_type === UserTypes::ACCOUNTING_TYPE->value;
    }

    /**
     * Является табельщиком
     *
     * @return bool
     */
    public function isTimeKeeper(): bool
    {
        return ($this->user_type === UserTypes::TEACHER_TYPE->value) && ($this->is_time_keeper);
    }

    /**
     * @param BaseCreateUserDto $dto
     * @return bool
     */
    public static function createAdmin(BaseCreateUserDto $dto): bool
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

    /**
     * @return string
     */
    public function getMainRouteName(): string
    {
        if ($this->isHr()) {
            return RouteNames::HR_DASHBOARD;
        }

        if ($this->isAccounting()) {
            return RouteNames::ACCOUNTING_DASHBOARD;
        }

        return RouteNames::TIME_KEEPER_DASHBOARD;
    }

    /**
     * @return HasMany
     */
    public function reportCards(): HasMany
    {
        return $this->hasMany(ReportCard::class, ReportCard::USER_ID);
    }
}
