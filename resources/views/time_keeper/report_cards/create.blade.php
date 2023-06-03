@php use App\Utils\RouteNames;
 /**
* @var \App\Models\User[] $regularWorkers
 */

 $lastMonth = now()->subMonth();
 $daysInLastMonth = $lastMonth->daysInMonth();
 $dayOfWeek = $lastMonth->startOfMonth()->format('l');
@endphp
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
                    action="{{ route(RouteNames::REPORT_CARDS_CREATE) }}"
                    method="post" class="ajax">
                    <div class="card-body">
                        <div class="mb-3">
                            <table class="table table-vcenter card-table">
                                <thead>
                                <tr>
                                    <th rowspan="2">ID</th>
                                    <th>ФИО</th>
                                    <th>Должность</th>
                                    <th>яв к</th>
                                    <th colspan="{{$daysInLastMonth}}">Дни</th>
                                    <th rowspan="2">Рабочие дни</th>
                                </tr>
                                <tr>
                                    <th colspan="3">Штатные сотрудники</th>
                                    @foreach(range(1,$daysInLastMonth) as $day)
                                        <th>{{$day}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($regularWorkers as $regularWorker)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$regularWorker->name}}</td>
                                        <td>{{$regularWorker->position?->name}}</td>
                                        <td></td>
                                        <input type="hidden" class="form-control" name="regularWorkers[{{$loop->iteration}}]['name']"
                                               value="{{$regularWorker->name}}">
                                        <input type="hidden" class="form-control" name="regularWorkers[{{$loop->iteration}}]['name']"
                                               value="{{$regularWorker->position?->name}}">
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{{$position->name ?? ''}}"
                                               placeholder="Пример: Доцент">
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content here -->
@endsection
