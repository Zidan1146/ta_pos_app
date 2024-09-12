<?php

namespace App\Http\Controllers\Pages\Admin\Manage;

use App\Http\Controllers\Templates\BaseCRUDController;
use App\Models\Cashier;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class CashierController extends BaseCRUDController
{
    public function __construct()
    {
        $this->model = Cashier::class;
        $this->viewPath = 'admin.manage_cashier';
        $this->routePath = 'admin.cashier';
        $this->item = 'cashier';
    }

    public function store(Request $request, $data = null, Closure $errorHandler = null) {
        return parent::store($request, [
            'id' => Uuid::uuid4()->toString(),
            'username' => $request->username,
            'telephone-number' => $request->input('telephone-number'),
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'address' => $request->address ?? '-',
        ]);
    }
    public function update($id, Request $request, $data = null, Closure $errorHandler = null) {
        return parent::update($id, $request, [
            'username' => $request->username,
            'telephone-number' => $request->input('telephone-number'),
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address ?? '-',
        ]);
    }
    public function validateRequest(Request $request, $isDataReturned = false) {
        $data = [
            "username" => "required|min:4|max:255",
            "email" => "required|regex:/^([a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+)$/|min:4|max:255",
            "telephone-number" => "required|numeric",
            "gender" => "required|in:male,female",
            "password" => "required|min:8|max:255"
        ];


        if($isDataReturned) {
            return $data;
        }
        $request->validate($data);
        return null;
    }
}
