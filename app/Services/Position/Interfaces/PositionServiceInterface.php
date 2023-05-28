<?php

namespace App\Services\Position\Interfaces;

use App\Http\Dto\Position\BaseCreatePositionDto;
use App\Http\Dto\Position\BaseEditPositionDto;
use App\Http\Dto\Position\BaseUpdatePositionDto;
use App\Services\ServiceResponse;

interface PositionServiceInterface
{
    /**
     * @return ServiceResponse
     */
    public function index(): ServiceResponse;

    public function edit(BaseEditPositionDto $dto): ServiceResponse;

    public function update(BaseUpdatePositionDto $dto): ServiceResponse;

    public function store(BaseCreatePositionDto $dto): ServiceResponse;
}
