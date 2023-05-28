@extends('layouts.master')
@section('content')
    <div class="container-xl">
        <div class="col-12">
            <div class="card-header">
                <ul class="nav nav-pills ">
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{route(\App\Utils\RouteNames::USER_CREATE)}}">
                            Создать
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Email</th>
                            <th>Отдел</th>
                            <th>Должность</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        {{$user->id}}
                                    </div>
                                </td>
                                <td>
                                    <div class="">{{$user->name}}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{$user->email}}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{\App\Http\Enums\UserTypes::getUserTypeText($user->user_type)}}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{$user->position?->name}}</div>
                                </td>
                                <td>
                                    <a href="{{route(\App\Utils\RouteNames::USER_EDIT, $user->id)}}">Изменить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
