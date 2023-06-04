<?php

namespace App\Http\Controllers\Web\Hr;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseWebController;
use Illuminate\Http\Request;

abstract class HrBaseController extends BaseWebController
{
    public const PATH_VIEW = 'hr.';
    public const POSITION_VIEW = 'positions.';
    public const DEPARTMENT_VIEW = 'departments.';

}
