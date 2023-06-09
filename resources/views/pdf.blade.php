<?php

use App\Utils\RouteNames;

/**
 * @var \App\Models\User[] $regularWorkers
 * @var \App\Models\ReportCard $reportCard
 */

$data = json_decode($reportCard->data, 1);
?>


@extends('auth.master')
@section('content')
@push('styles')
    <style>
        .rotated-table {
            /*transform: rotate(90deg);*/
            /*transform-origin: left top;*/
            width: 50% !important;
            /*white-space: nowrap;*/
        }
        </style>
@endpush
<div class="rotated-table">
    <div class=" ">
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

