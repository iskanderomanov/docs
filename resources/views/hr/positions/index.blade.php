@extends('layouts.master')
@section('content')
    <div class="container-xl">
        <div class="col-12">
            <div class="card-header">
                <ul class="nav nav-pills ">
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{route(\App\Utils\RouteNames::POSITION_CREATE)}}">
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
                            <th>Название</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($positions as $position)
                            <tr>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        {{$position->id}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-muted">{{$position->name}}</div>
                                </td>
                                <td>
                                    <a href="{{route(\App\Utils\RouteNames::POSITION_EDIT, $position->id)}}">Изменить</a>
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
