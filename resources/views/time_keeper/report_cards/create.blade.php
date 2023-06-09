<?php

use App\Utils\RouteNames;

/**
 * @var \App\Models\User[] $regularWorkers
 */

$lastMonth = Carbon\Carbon::now()->subMonth();
$daysInLastMonth = $lastMonth->copy()->endOfMonth()->day;
$dayOfWeek = $lastMonth->startOfMonth()->format('l');
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
                           href="{{route(RouteNames::REPORT_CARDS_INDEX)}}">
                            Назад
                        </a>
                    </li>
                </ul>
                <h3 class="card-title">Создание табеля</h3>
            </div>

            <div class="col-lg-12 mb-3">
                <form
                    action="{{ route(RouteNames::REPORT_CARDS_STORE) }}"
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
                                        <th colspan="{{$daysInLastMonth}}" class="text-center">Дни</th>
                                        <th rowspan="2" style="display: table-cell;
    vertical-align: middle">Рабочие дни
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach(range(1,$daysInLastMonth) as $day)
                                            <th>{{$day}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <th colspan="{{$daysInLastMonth + 5}}" class="text-center">Штатта иштегендер</th>
                                    @foreach($regularWorkers as $regularWorker)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$regularWorker->name}}</td>
                                            <td>{{$regularWorker->position?->name}}</td>
                                            <td>
                                                {{$regularWorker->rates[0]->rate}}
                                            </td>
                                                <?php $col = 0; ?>
                                            @foreach(range(1,$daysInLastMonth) as $day)

                                                <td><input style="width: 25px" type="text"
                                                           value="{{isWeekend($lastMonth->copy()->startOfMonth()->addDays($day-1)) ? 'В' : 6 }}"
                                                           name='regularWorkers[{{$regularWorker->id}}][days][{{$day}}]'/>
                                                </td>

                                                    <?php if (!isWeekend($lastMonth->copy()->startOfMonth()->addDays($day - 1))) {
                                                    $col++;} ?>
                                            @endforeach
                                            <td>{{$col}}</td>
                                            <input type="hidden" name="regularWorkers[{{$regularWorker->id}}][user][rate]" value="{{$regularWorker->rates[0]->rate}}">
                                            <input type="hidden" name="regularWorkers[{{$regularWorker->id}}][user][workDays]"
                                                   value="{{$col}}">
                                            <input type="hidden" class="form-control"
                                                   name="regularWorkers[{{$regularWorker->id}}][user][position]"
                                                   value="{{$regularWorker->position?->name}}">
                                            <input type="hidden" class="form-control" name="regularWorkers[{{$regularWorker->id}}][user][name]" id="name"
                                                   value="{{$regularWorker->name ?? ''}}">
                                        </tr>
                                    @endforeach
                                    <th colspan="{{$daysInLastMonth + 5}}" class="text-center">Кошумча ставка</th>
                                    @foreach($additionalWorkers as $regularWorker)
                                        @if(isset($regularWorker->rates[0]))
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$regularWorker->name}}</td>
                                                <td>{{$regularWorker->position?->name}}</td>
                                                <td>
                                                    {{$regularWorker->rates[0]->rate}}
                                                </td>
                                                    <?php $col = 0; ?>
                                                    <?php $hourRate = 6 * $regularWorker->rates[0]->rate ?>

                                                @foreach(range(1,$daysInLastMonth) as $day)

                                                    <td><input style="width: 25px" type="text"
                                                               value="{{isWeekend($lastMonth->copy()->startOfMonth()->addDays($day-1)) ? 'В' : $hourRate }}"
                                                               name='additionalWorker[{{$regularWorker->id}}][days][{{$day}}]'/>
                                                    </td>
                                                        <?php if (!isWeekend($lastMonth->copy()->startOfMonth()->addDays($day - 1))) {
                                                        $col++;} ?>
                                                @endforeach

                                                <td>{{$col}}</td>
                                                <input type="hidden" name="additionalWorker[{{$regularWorker->id}}][user][workDays]"
                                                       value="{{$col}}">
                                                <input type="hidden" name="additionalWorker[{{$regularWorker->id}}][user][rate]" value="{{$regularWorker->rates[0]->rate}}">

                                                <input type="hidden" class="form-control"
                                                       name="additionalWorker[{{$regularWorker->id}}][user][position]"
                                                       value="{{$regularWorker->position?->name}}">
                                                <input type="hidden" class="form-control" name="additionalWorker[{{$regularWorker->id}}][user][name]" id="name"
                                                       value="{{$regularWorker->name ?? ''}}">

                                            </tr>
                                        @endif
                                    @endforeach
                                    <th colspan="{{$daysInLastMonth + 5}}" class="text-center">Айкалыштырып иштегендер
                                    </th>
                                    @foreach($hiredWorkers as $regularWorker)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$regularWorker->name}}</td>
                                            <td>{{$regularWorker->position?->name}}</td>
                                            <td>
                                                {{$regularWorker->rates[0]->rate}}
                                            </td>
                                                <?php $col = 0; ?>
                                                <?php $hourRate = 6 * $regularWorker->rates[0]->rate ?>
                                            @foreach(range(1,$daysInLastMonth) as $day)

                                                <td><input style="width: 25px" type="text"
                                                           value="{{isWeekend($lastMonth->copy()->startOfMonth()->addDays($day-1)) ? 'В' : $hourRate }}"
                                                           name='hiredWorkers[{{$regularWorker->id}}][days][{{$day}}]'/>
                                                </td>
                                                    <?php if (!isWeekend($lastMonth->copy()->startOfMonth()->addDays($day - 1))) {
                                                    $col++;} ?>
                                            @endforeach
                                            <td>{{$col}}</td>
                                            <input type="hidden" name="hiredWorkers[{{$regularWorker->id}}][user][workDays]"
                                                   value="{{$col}}">
                                            <input type="hidden" class="form-control"
                                                   name="hiredWorkers[{{$regularWorker->id}}][user][position]"
                                                   value="{{$regularWorker->position?->name}}">
                                            <input type="hidden" class="form-control" name="hiredWorkers[{{$regularWorker->id}}][user][name]" id="name"
                                                   value="{{$regularWorker->name ?? ''}}">
                                            <input type="hidden" name="hiredWorkers[{{$regularWorker->id}}][user][rate]" value="{{$regularWorker->rates[0]->rate}}">

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="invalid-feedback" id="error"></div>
                            <input type="hidden" name="days" value="{{$daysInLastMonth}}">
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

