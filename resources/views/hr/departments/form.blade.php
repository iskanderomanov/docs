@php use App\Utils\RouteNames; @endphp
@extends('layouts.master')
@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills ">
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{route(RouteNames::DEPARTMENT_INDEX)}}">
                            Назад
                        </a>
                    </li>
                </ul>
                <h3 class="card-title">Создание кафедры</h3>
            </div>

            <div class="col-lg-12 mb-3">
                <form
                    action="{{ isset($department) ? route(RouteNames::DEPARTMENT_UPDATE,$department->id) : route(RouteNames::DEPARTMENT_STORE) }}"
                    method="post" class="ajax">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Название *</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$department->name ?? ''}}"
                                   placeholder="Название кафедры">
                            <div class="invalid-feedback"></div>
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
