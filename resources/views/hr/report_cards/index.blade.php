<?php

use App\Models\ReportCard;

/**
 * @var ReportCard[] $reportCards
 */
?>
@extends('layouts.master')
@section('content')
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reportCards as $reportCard)
                            <tr>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        {{$reportCard->id}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-muted">{{$reportCard->name}}</div>
                                </td>
                                <td>
                                    <div class="text-muted">
                                        <p class="badge {{$reportCard->getStatusCssClass()}}">
                                            {{$reportCard->getStatusText()}}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-muted">{{$reportCard->created_at}}</div>
                                </td>
                                <td>
                                    <a href="{{ route(\App\Utils\RouteNames::HR_REPORT_CARDS_SHOW, $reportCard->id) }}">Просмотр</a>
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
