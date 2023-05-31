<?php

namespace App\Services\User\Interfaces;

use App\Http\Dto\User\BaseCreateUserDto;
use App\Http\Dto\User\BaseEditUserDto;
use App\Services\ServiceResponse;

interface UserServiceInterface
{
    public function index(): ServiceResponse;

    public function edit(BaseEditUserDto $dto): ServiceResponse;

    public function update(): ServiceResponse;

    public function store(): ServiceResponse;

    public function create(BaseCreateUserDto $dto): ServiceResponse;
}
