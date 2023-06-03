<?php

namespace App\Repositories\ReportCard;

use App\Repositories\ReportCard\Interfaces\ReportCardRepositoryInterface;
use Exception;

class ReportCardRepositoryFactory
{
    /**
     * @param string $type
     * @return ReportCardRepositoryInterface
     * @throws Exception
     */
    public function createRepository(string $type = DbReportCardRepository::class): ReportCardRepositoryInterface
    {
        return match ($type) {
            DbReportCardRepository::class => new DbReportCardRepository(),
            default => throw new Exception('Repository type not found'),
        };
    }

}
