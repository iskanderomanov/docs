<?php

namespace App\Http\Controllers\Web\TimeKeeper;

use App\Services\ReportCard\Interfaces\ReportCardServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReportCardController extends TimeKeeperBaseController
{
    public const  VIEW = 'report_cards.';
    /**
     * @var ReportCardServiceInterface
     */
    public ReportCardServiceInterface $reportCardService;

    public function __construct(
        ReportCardServiceInterface $reportCardService
    )
    {
        $this->reportCardService = $reportCardService;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $response = $this->reportCardService->index();
        return view(self::PATH_VIEW . self::VIEW . self::INDEX_VIEW, $response->getResult());
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        $response = $this->reportCardService->create();
        return view(self::PATH_VIEW . self::VIEW . self::CREATE_VIEW, $response->getResult());
    }

    public function store()
    {

    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $response = $this->reportCardService->edit($id);
        return view(self::PATH_VIEW . self::VIEW . self::EDIT_VIEW, $response->getResult());
    }

    public function update()
    {

    }
}
