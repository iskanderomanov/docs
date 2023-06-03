<?php

namespace App\Models;

use App\Http\Dto\Position\BaseCreatePositionDto;
use App\Http\Dto\Position\BaseUpdatePositionDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $position_id
 * @property string $name
 */
class Position extends BaseModel
{
    use HasFactory;

    /**
     * @var bool
     * Отключаем updated_at и created_at
     */
    public $timestamps = false;

    /**
     * Здесь описываются название колонок в таблице
     *  Название доступа
     */
    public const NAME_COLUMN = 'name';

    public const ID_COLUMN = 'id';

    /**
     *  Название 'разрешение роли'
     */
    public const POSITION_ID_COLUMN = 'position_id';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::NAME_COLUMN
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, self::POSITION_ID_COLUMN);
    }

    /**
     * @param BaseCreatePositionDto $dto
     * @return bool
     */
    public static function createPosition(BaseCreatePositionDto $dto): bool
    {
        return (new self($dto->toArray()))->save();
    }

    /**
     * @param BaseUpdatePositionDto $dto
     * @return mixed
     */
    public static function updatePosition(BaseUpdatePositionDto $dto): mixed
    {
        return Position::where(self::ID_COLUMN, $dto->id)
            ->update([self::NAME_COLUMN => $dto->name]);
    }
}
