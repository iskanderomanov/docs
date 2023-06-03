<?php

namespace App\Services\ReportCard\Interfaces;

use App\Services\ServiceResponse;

interface ReportCardServiceInterface
{
    public function index(): ServiceResponse;

    public function create(): ServiceResponse;

    public function store(): ServiceResponse;

    public function edit(int $id): ServiceResponse;

    public function update(): ServiceResponse;
}
