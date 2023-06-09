<?php

namespace App\View;

use App\Http\Enums\UserTypes;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarView
{
    /**
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        if (Auth::user()) {
            $view->with('navbar_view', view($this->getView())->render());
        }
    }

    /**
     * @return string
     */
    private function getView(): string
    {
        return match (Auth::user()->user_type) {
            UserTypes::HR_TYPE->value => 'hr.layouts.navbar_view',
            UserTypes::ACCOUNTING_TYPE->value => 'accounting.layouts.navbar_view',
            UserTypes::TEACHER_TYPE->value => 'time_keeper.layouts.navbar_view'
        };
    }
}
