<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

abstract class BaseWebController extends Controller
{
    public const DASHBOARD_PATH = 'dashboard.';
    public final const INDEX_VIEW = 'index';
    public final const CREATE_VIEW = 'create';
    public final const EDIT_VIEW = 'edit';
    public final const FORM_VIEW = 'form';
}
