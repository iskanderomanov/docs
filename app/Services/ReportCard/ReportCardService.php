<?php

namespace App\Services\ReportCard;

use App\Repositories\ReportCard\Interfaces\ReportCardRepositoryInterface;
use App\Repositories\ReportCard\ReportCardRepositoryFactory;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Repositories\User\UserRepositoryFactory;
use App\Services\ReportCard\Interfaces\ReportCardServiceInterface;
use App\Services\Service;
use App\Services\ServiceResponse;

class ReportCardService extends Service implements ReportCardServiceInterface
{
    public const REPORT_CARDS = 'reportCards';
    public const REPORT_CARD = 'reportCard';
    private ReportCardRepositoryInterface $reportCardRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct()
    {
        $this->reportCardRepository = (new ReportCardRepositoryFactory())->createRepository();
        $this->userRepository = (new UserRepositoryFactory())->createRepository();
    }

    public function index(): ServiceResponse
    {
        return $this->createResponse([
            self::REPORT_CARDS => $this->reportCardRepository->getAll()
        ]);
    }

    public function create(): ServiceResponse
    {
        $departmentId = auth()->user()->department_id;
        return $this->createResponse([
            'regularWorkers' => $this->userRepository->getRegularTeachers($departmentId),
            'additionalWorkers' => $this->userRepository->getAdditionalTeachers($departmentId),
            'hiredWorkers' => $this->userRepository->getHiredTeachers($departmentId)
        ]);
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
