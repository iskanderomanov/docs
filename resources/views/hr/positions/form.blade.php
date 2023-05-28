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
                           href="{{route(RouteNames::POSITION_INDEX)}}">
                            Назад
                        </a>
                    </li>
                </ul>
                <h3 class="card-title">Создание должности</h3>
            </div>


            <div class="col-lg-12 mb-3">
                <form
                    action="{{ isset($position) ? route(RouteNames::POSITION_UPDATE,$position->id) : route(RouteNames::POSITION_STORE) }}"
                    method="post" class="ajax">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Название *</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$position->name ?? ''}}"
                                   placeholder="Пример: Доцент">
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
