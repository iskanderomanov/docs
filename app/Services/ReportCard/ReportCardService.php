<?php

namespace App\Services\ReportCard;

use App\Repositories\ReportCard\Interfaces\ReportCardRepositoryInterface;
use App\Repositories\ReportCard\ReportCardRepositoryFactory;
use App\Services\ReportCard\Interfaces\ReportCardServiceInterface;
use App\Services\Service;
use App\Services\ServiceResponse;

class ReportCardService extends Service implements ReportCardServiceInterface
{
    public const REPORT_CARDS = 'reportCards';
    public const REPORT_CARD = 'reportCard';
    private ReportCardRepositoryInterface $reportCardRepository;

    public function __construct()
    {
        $this->reportCardRepository = (new ReportCardRepositoryFactory())->createRepository();
    }

    public function index(): ServiceResponse
    {
        return $this->createResponse([
            self::REPORT_CARDS => $this->reportCardRepository->getAll()
        ]);
    }

    public function create(): ServiceResponse
    {
        return $this->createResponse([]);
    }

    public function store(): ServiceResponse
    {
        // TODO: Implement store() method.
    }

    public function edit(int $id): ServiceResponse
    {
        // TODO: Implement edit() method.
    }

    public function update(): ServiceResponse
    {
        // TODO: Implement update() method.
    }
}
