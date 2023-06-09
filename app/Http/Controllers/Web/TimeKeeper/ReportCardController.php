<?php

namespace App\Http\Controllers\Web\TimeKeeper;

use App\Http\Enums\StatusTypes;
use App\Http\Responses\ResponseBuilder;
use App\Models\ReportCard;
use App\Services\ReportCard\Interfaces\ReportCardServiceInterface;
use App\Utils\RouteNames;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'name' => "Отчет за " . now()->toDateString(),
            'data' => json_encode($request->all()),
            'status' => StatusTypes::AWAITING_VERIFICATION_HR->value,
            'description_answer' => ''
        ];

        ReportCard::create($data);

        return ResponseBuilder::jsonRedirect(route(RouteNames::REPORT_CARDS_INDEX));
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $reportCard = ReportCard::find($id);

        return view(self::PATH_VIEW . self::VIEW . self::EDIT_VIEW, ['reportCard' => $reportCard]);
    }

    public function update(Request  $request,int $id)
    {
        $model = ReportCard::where('id',$id)->first();
        $model->data = json_encode($request->all());
        $model->status = $model->status === StatusTypes::ERROR_FROM_ACCOUNTING->value ? StatusTypes::AWAITING_VERIFICATION_ACCOUNTING : StatusTypes::AWAITING_VERIFICATION_HR;

        $model->save();
        return ResponseBuilder::jsonRedirect(route(RouteNames::REPORT_CARDS_INDEX));

    }
}
