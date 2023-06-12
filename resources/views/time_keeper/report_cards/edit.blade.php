<?php

use App\Utils\RouteNames;

/**
 * @var \App\Models\User[] $regularWorkers
 * @var \App\Models\ReportCard $reportCard
 */

$data = json_decode($reportCard->data, 1);
;
?>


@extends('layouts.master')
@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills ">
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{route(RouteNames::HR_REPORT_CARDS_INDEX)}}">
                            Назад
                        </a>
                    </li>
                </ul>
                <h3 class="card-title">Просмотр табеля</h3>
            </div>

            <div class="col-lg-12 mb-3">
                <form
                    action="{{ route(RouteNames::REPORT_CARDS_UPDATE,$reportCard->id) }}"
                    method="post" class="ajax">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="align-items-center center" style="display: table-cell;
    vertical-align: middle">ID
                                        </th>
                                        <th rowspan="2" style="display: table-cell;
    vertical-align: middle">ФИО
                                        </th>
                                        <th rowspan="2" style="display: table-cell;
    vertical-align: middle">Должность
                                        </th>
                                        <th rowspan="2" style="display: table-cell;
    vertical-align: middle">яв к
                                        </th>
                                        <th colspan="{{$data['days']}}" class="text-center">Дни</th>
                                        <th rowspan="2" style="display: table-cell;
    vertical-align: middle">Рабочие дни
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach(range(1,$data['days']) ?? [] as $day)
                                            <th>{{$day}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <th colspan="{{$data['days'] + 5}}" class="text-center">Штатта иштегендер</th>
                                    @foreach($data['regularWorkers'] ?? [] as $id => $regularWorker)
                                        <tr>
                                            <td>
                                               {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{shortenName($regularWorker['user']['name'])}}</td>
                                            <td>{{shortenName($regularWorker['user']['position'])}}</td>
                                            <td>
                                                {{$regularWorker['user']['rate']}}
                                            </td>
                                            @foreach($regularWorker['days'] ?? [] as $key => $day)
                                                <td>
                                                    <input style="width: 25px" type="text"
                                                           value="{{$day}}"
                                                           name='regularWorkers[{{$id}}][days][]'/>
                                                </td>
                                            @endforeach
                                            <td>{{$regularWorker['user']['workDays']}}</td>

                                            <input type="hidden" name="regularWorkers[{{$id}}][user][workDays]"
                                                   value="{{$regularWorker['user']['workDays']}}">
                                            <input type="hidden" class="form-control"
                                                   name="regularWorkers[{{$id}}][user][position]"
                                                   value="{{shortenName($regularWorker['user']['position'])}}">
                                            <input type="hidden" class="form-control" name="regularWorkers[{{$id}}][user][name]" id="name"
                                                   value="{{shortenName($regularWorker['user']['name'])}}">
                                            <input type="hidden" name="regularWorkers[{{$id}}][user][rate]" value="{{$regularWorker['user']['rate']}}">

                                        </tr>
                                    @endforeach
                                    <th colspan="{{$data['days'] + 5}}" class="text-center">Кошумча ставка</th>
                                    @foreach($data['additionalWorker'] ?? [] as $id => $regularWorker)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{shortenName($regularWorker['user']['name'])}}</td>
                                            <td>{{shortenName($regularWorker['user']['position'])}}</td>
                                            <td>
                                                {{$regularWorker['user']['rate']}}
                                            </td>
                                            @foreach($regularWorker['days'] as $day)
                                                <td>
                                                    <input style="width: 25px" type="text"
                                                           value="{{$day}}"
                                                           name='additionalWorker[{{$id}}][days][]'/>
                                                </td>
                                            @endforeach
                                            <td>{{$regularWorker['user']['workDays']}}</td>
                                            <input type="hidden" name="additionalWorker[{{$id}}][user][workDays]"
                                                   value="{{$regularWorker['user']['workDays']}}">
                                            <input type="hidden" class="form-control"
                                                   name="additionalWorker[{{$id}}][user][position]"
                                                   value="{{shortenName($regularWorker['user']['position'])}}">
                                            <input type="hidden" class="form-control" name="additionalWorker[{{$id}}][user][name]" id="name"
                                                   value="{{shortenName($regularWorker['user']['name'])}}">
                                            <input type="hidden" name="additionalWorker[{{$id}}][user][rate]" value="{{$regularWorker['user']['rate']}}">

                                        </tr>
                                    @endforeach
                                    <th colspan="{{$data['days'] + 5}}" class="text-center">Айкалыштырып иштегендер
                                    </th>
                                    @foreach($data['hiredWorkers'] ?? [] as $id => $regularWorker)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{shortenName($regularWorker['user']['name'])}}</td>
                                            <td>{{shortenName($regularWorker['user']['position'])}}</td>
                                            <td>
                                                {{$regularWorker['user']['rate']}}
                                            </td>
                                            @foreach($regularWorker['days'] as $day)
                                                <td>
                                                    <input style="width: 25px" type="text"
                                                           value="{{$day}}"
                                                           name='hiredWorkers[{{$id}}][days][]'/>
                                                </td>
                                            @endforeach
                                            <td>{{$regularWorker['user']['workDays']}}</td>
                                            <input type="hidden" name="hiredWorkers[{{$id}}][user][workDays]"
                                                   value="{{$regularWorker['user']['workDays']}}">
                                            <input type="hidden" class="form-control"
                                                   name="hiredWorkers[{{$id}}][user][position]"
                                                   value="{{shortenName($regularWorker['user']['position'])}}">
                                            <input type="hidden" class="form-control" name="hiredWorkers[{{$id}}][user][name]" id="name"
                                                   value="{{shortenName($regularWorker['user']['name'])}}">
                                            <input type="hidden" name="hiredWorkers[{{$id}}][user][rate]" value="{{$regularWorker['user']['rate']}}">

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div>
                                {{\App\Http\Enums\StatusTypes::getStatusText($reportCard->status)}}
                            </div>
                            <div name="description_answer" id="" class="form-control mb-3 mt-3">{{$reportCard->description_answer}}</div>

                            <div class="invalid-feedback" id="error"></div>
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </div>
                    <input type="hidden" name="days" value="{{$data['days']}}">

                </form>
            </div>
        </div>
    </div>
    <!-- Content here -->
@endsection
<?php
function isWeekend($date)
{
    return $date->isWeekend();
}
?>


@push('scripts')

@endpush

