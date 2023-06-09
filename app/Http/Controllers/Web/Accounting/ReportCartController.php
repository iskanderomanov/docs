<?php

namespace App\Http\Controllers\Web\Accounting;

use App\Http\Enums\StatusTypes;
use App\Http\Responses\ResponseBuilder;
use App\Models\ReportCard;
use App\Utils\RouteNames;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class ReportCartController extends AccountingBaseController
{
    public function index()
    {
        $statuses = [StatusTypes::SUCCESS->value, StatusTypes::AWAITING_VERIFICATION_ACCOUNTING->value];
        $reportCards = ReportCard::whereIn('status', $statuses)->get();
        return view('accounting.report_cards.index', ['reportCards' => $reportCards]);
    }

    public function show(int $id)
    {
        return view('accounting.report_cards.show', ['reportCard' => ReportCard::where('id', $id)->first()]);
    }

    public function update(Request $request, int $id)
    {
        $model = ReportCard::where('id', $id)->first();
        $model->description_answer = $request->description_answer;
        $model->status = $request->status;

        $model->save();
        return ResponseBuilder::jsonRedirect(route(RouteNames::A_REPORT_CARDS_INDEX));
    }

    public function savePdf($id)
    {
        $dompdf = new Dompdf();
        $model = ReportCard::where('id', $id)->first();

        // Установка опций для Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial Unicode MS');
        $options->set('isPhpEnabled', true); // Включение PHP-кода в представлении
        $dompdf->setOptions($options);

        $html = view('pdf', ['reportCard' => $model,])->render();

        $dompdf->loadHtml($html);

        // Рендеринг PDF
        $dompdf->render();

        // Установка размера страницы в горизонтальную ориентацию
        $dompdf->setPaper('A4', 'landscape');

        // Генерация имени файла PDF
        $filename = $model->name. "_" . now()->toDateString().'.pdf';

        // Сохранение PDF на сервере
        $dompdf->stream($filename);

        // Возврат ответа
        return response()->streamDownload(function () use ($dompdf) {
            echo $dompdf->output();
        }, $filename);
    }
}
