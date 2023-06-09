<?php

namespace App\Http\Controllers\Web\Hr;

use App\Http\Enums\StatusTypes;
use App\Http\Responses\ResponseBuilder;
use App\Models\ReportCard;
use App\Utils\RouteNames;
use Illuminate\Http\Request;

class ReportCardController extends HrController
{
    public function index()
    {
        $reportCards = ReportCard::where('status', StatusTypes::AWAITING_VERIFICATION_HR->value)->get();
        return view('hr.report_cards.index', ['reportCards' => $reportCards]);
    }

    public function show(int $id){
        return view('hr.report_cards.show', ['reportCard' => ReportCard::where('id', $id)->first()]);
    }

    public function update(Request  $request,int $id)
    {
        $model = ReportCard::where('id',$id)->first();
        $model->description_answer = $request->description_answer;
        $model->status = $request->status;

        $model->save();
        return ResponseBuilder::jsonRedirect(route(RouteNames::HR_REPORT_CARDS_INDEX));

    }
}
