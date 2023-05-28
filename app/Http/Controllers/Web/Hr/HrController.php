<?php

namespace App\Http\Controllers\Web\Hr;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HrController extends HrBaseController
{
    /**
     * @return Factory|View|Application
     */
    public function dashboard(): Factory|View|Application
    {
        return view(self::PATH_VIEW . self::DASHBOARD_PATH . self::INDEX_VIEW);
    }
}
