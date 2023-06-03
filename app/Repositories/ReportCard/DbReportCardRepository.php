<?php

namespace App\Repositories\ReportCard;

use App\Models\ReportCard;
use App\Repositories\ReportCard\Interfaces\ReportCardRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DbReportCardRepository implements ReportCardRepositoryInterface
{

    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return ReportCard::query()->orderBy(ReportCard::ID_COLUMN)->get();
    }
}
