<?php

namespace App\Services\User\Interfaces;

use App\Http\Dto\Hr\BaseCreateHrDto;
use App\Services\ServiceResponse;

interface UserServiceInterface
{
    public function index(): ServiceResponse;

    public function edit(): ServiceResponse;

    public function update(): ServiceResponse;

    public function store(): ServiceResponse;

    public function create(BaseCreateHrDto $dto): ServiceResponse;
}
