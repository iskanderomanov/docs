<?php

use App\Utils\RouteNames;

/**
 * @var \App\Models\User[] $regularWorkers
 * @var \App\Models\ReportCard $reportCard
 */

$data = json_decode($reportCard->data, 1);
?>


@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills ">
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{route(RouteNames::A_REPORT_CARDS_INDEX)}}">
                            Назад
                        </a>
                    </li>
                </ul>
                <button onclick="window.print();"
                        class="btn btn-sm btn-secondary d-flex align-items-center">
                    <i class="cil-print mr-1"></i>
                    Скачать в ПДФ
                 </button>
                <h3 class="card-title"> Просмотр табеля</h3>
            </div>

            <div class="col-lg-12 mb-3">
                <form
                    action="{{ route(RouteNames::A_REPORT_CARDS_UPDATE,$reportCard->id) }}"
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
                                        @foreach(range(1,$data['days']) as $day)
                                            <th>{{$day}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <th colspan="{{$data['days'] + 5}}" class="text-center">Штатта иштегендер</th>
                                    @foreach($data['regularWorkers'] as $regularWorker)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$regularWorker['user']['name']}}</td>
                                            <td>{{$regularWorker['user']['position']}}</td>
                                            <td>
                                                {{$regularWorker['user']['rate']}}
                                            </td>
                                            @foreach($regularWorker['days'] as $day)

                                                <td>{{$day}}
                                                </td>
                                            @endforeach
                                            <td>{{$regularWorker['user']['workDays']}}</td>
                                        </tr>
                                    @endforeach
                                    <th colspan="{{$data['days'] + 5}}" class="text-center">Кошумча ставка</th>
                                    @foreach($data['additionalWorker'] as $regularWorker)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$regularWorker['user']['name']}}</td>
                                                <td>{{$regularWorker['user']['position']}}</td>
                                                <td>
                                                    {{$regularWorker['user']['rate']}}
                                                </td>
                                                @foreach($regularWorker['days'] as $day)
                                                    <td>{{$day}}
                                                    </td>
                                                @endforeach
                                                    <td>{{$regularWorker['user']['workDays']}}</td>
                                            </tr>
                                    @endforeach
                                    <th colspan="{{$data['days'] + 5}}" class="text-center">Айкалыштырып иштегендер
                                    </th>
                                    @foreach($data['hiredWorkers'] as $regularWorker)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$regularWorker['user']['name']}}</td>
                                            <td>{{$regularWorker['user']['position']}}</td>
                                            <td>
                                                {{$regularWorker['user']['rate']}}
                                            </td>
                                            @foreach($regularWorker['days'] as $day)

                                                <td>{{$day}}
                                                </td>
                                            @endforeach
                                            <td>{{$regularWorker['user']['workDays']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <select name="status" class="form-control">
                                @foreach(\App\Http\Enums\StatusTypes::getStatusesText() as $key => $status)
                                    <option value="{{$key}}" {{$reportCard->status === $key ? 'selected' : '' }}>{{$status}}</option>
                                @endforeach
                            </select>
                            <textarea name="description_answer" id="" class="form-control mb-3 mt-3">{{$reportCard->description_answer}}</textarea>

                            <div class="invalid-feedback" id="error"></div>
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </div>
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

