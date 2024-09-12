<?php

namespace App\Http\Controllers\Pages\Admin\TransactionHistory;

use App\Http\Controllers\Templates\BasePageController;
use App\Models\Transaction;

class TransactionHistoryController extends BasePageController
{
    protected $viewPath = "admin.transaction_history";

    public function index($extraData = []) {
        $transactionData = Transaction::orderBy('created_at')->get();
        $timeData = Transaction::distinct()->orderBy('created_at')->get(['created_at']);

        $extraData = [
            'transactionData' => $transactionData,
            'timeData' => $timeData
        ];

        return parent::index($extraData);
    }
}
