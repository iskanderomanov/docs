<?php

namespace App\Services\User\Interfaces;

use App\Http\Dto\User\BaseCreateUserDto;
use App\Http\Dto\User\BaseEditUserDto;
use App\Http\Dto\User\BaseUpdateUserDto;
use App\Services\ServiceResponse;

interface UserServiceInterface
{
    public function index(): ServiceResponse;

    public function edit(BaseEditUserDto $dto): ServiceResponse;

    public function update(BaseUpdateUserDto $dto): ServiceResponse;

    public function store(BaseCreateUserDto $dto): ServiceResponse;

    public function getCreate(): ServiceResponse;
}
