<?php

namespace App\Models;

use App\Http\Dto\Department\BaseCreateDepartmentDto;
use App\Http\Dto\Department\BaseUpdateDepartmentDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends BaseModel
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
    public const DEPARTMENT_ID_COLUMN = 'department_id';

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
        return $this->belongsToMany(User::class, self::DEPARTMENT_ID_COLUMN);
    }

    /**
     * @param BaseCreateDepartmentDto $dto
     * @return bool
     */
    public static function createDepartment(BaseCreateDepartmentDto $dto): bool
    {
        return (new self($dto->toArray()))->save();
    }

    /**
     * @param BaseUpdateDepartmentDto $dto
     * @return mixed
     */
    public static function updateDepartment(BaseUpdateDepartmentDto $dto): mixed
    {
        return Department::where(self::ID_COLUMN, $dto->id)
            ->update([self::NAME_COLUMN => $dto->name]);
    }
}
