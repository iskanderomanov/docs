<?php

namespace App\Repositories\Position;

use App\Http\Dto\Position\BaseEditPositionDto;
use App\Models\Position;
use App\Repositories\Position\Interfaces\PositionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DbPositionRepository implements PositionRepositoryInterface
{
    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return Position::query()->orderBy(Position::ID_COLUMN)->get();
    }

    /**
     * @param BaseEditPositionDto $dto
     * @return Position
     */
    public function find(BaseEditPositionDto $dto): Position
    {
        return Position::findOrFail($dto->id);
    }
}
