<?php

namespace App\Http\Controllers\Pages\Cashier\Transaction;

use App\Http\Controllers\Templates\BaseCRUDController;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionTemp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends BaseCRUDController
{
    protected $viewPath = "cashier.transaction";
    protected $model = TransactionTemp::class;
    protected $routePath = 'cashier.transaction';

    public function index($extraData = []) {
        $transactionItems = Item::orderBy('created_at')->paginate(10);
        $transactionBuyTemp = TransactionTemp::orderBy('created_at')->paginate(15);
        $extraData = [
            'transactionItems' => $transactionItems,
            'transactionBuyTemp' => $transactionBuyTemp
        ];

        return parent::index($extraData);
    }

    public function transaction(Request $request) {
        $spareMoney = intval($request->buy) - intval($request->totalCost);
        if($spareMoney < 0) {
            return redirect()->route('cashier.transaction.index')->withErrors('Not enough Money! You need '.abs($spareMoney).' more!');
        }
        $transactionTemps = TransactionTemp::all();
        $currentDate = Carbon::now();

        foreach($transactionTemps as $transactionTemp) {
            Transaction::create([
                'itemName' => $transactionTemp->item->name,
                'count' => $transactionTemp->count,
                'cost' => $transactionTemp->cost,
                'pay' => $request->buy,
                'date' => $currentDate->toDateTimeString(),
            ]);
        }

        TransactionTemp::truncate();
        return redirect()->route('cashier.transaction.index')->with('success', 'Transactions created successfully.');
    }

    public function validateRequest(Request $request, $isDataReturned = false) {
        $request->validate([
            'item_id' => 'exists:items,id',
            'count' => 'required|numeric|min:1'
        ]);

        return null;
    }

    public function store(Request $request, $data = null, \Closure $errorHandler = null) {
        $itemCost = Item::where('id', '=', $request->item_id)->pluck('sellCost')->first();

        $data = [
            'item_id' => $request->item_id,
            'cost' => $itemCost,
            'count' => $request->count
        ];

        return parent::store($request, $data);
    }
}
