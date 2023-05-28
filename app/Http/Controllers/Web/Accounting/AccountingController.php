<?php

namespace App\Http\Controllers\Web\Accounting;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AccountingController extends AccountingBaseController
{
    /**
     * @return Factory|View|Application
     */
    public function dashboard(): Factory|View|Application
    {
        return view(self::PATH_VIEW . self::DASHBOARD_PATH . self::INDEX_VIEW);
    }
}
