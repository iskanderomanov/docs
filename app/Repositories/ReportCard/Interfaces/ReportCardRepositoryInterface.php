<?php

namespace App\Repositories\ReportCard\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ReportCardRepositoryInterface
{
    public function getAll(): Collection|array;
}
