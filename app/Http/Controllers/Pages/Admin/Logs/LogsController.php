<?php

namespace App\Http\Controllers\Pages\Admin\Logs;

use App\Http\Controllers\Templates\BasePageController;
use App\Models\Log;

class LogsController extends BasePageController
{
    protected $viewPath = "admin.logs";

    public function index($extraData = []) {
        $logData = Log::all();

        return parent::index(['logs' => $logData]);
    }
}
