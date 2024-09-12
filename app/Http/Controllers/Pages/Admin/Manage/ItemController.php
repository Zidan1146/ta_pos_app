<?php

namespace App\Http\Controllers\Pages\Admin\Manage;

use App\Http\Controllers\Templates\BaseCRUDController;
use App\Models\Item;
use Closure;
use Illuminate\Http\Request;
use Faker\Factory as Faker;


class ItemController extends BaseCRUDController
{
    protected $viewPath = "admin.manage_item";
    protected $routePath = "admin.item";
    protected $model = Item::class;
    protected $item = "item";

    public function store(Request $request, $data = null, Closure $errorHandler = null) {
        $faker = Faker::create();

        return parent::store($request, [
            'id' => 'I'.rand(0, 999).$faker->randomLetter(),
            'name' => $request->name,
            'sellCost' => $request->sellCost,
            'buyCost' => $request->buyCost,
            'quantity' => $request->quantity,
            'description' => $request->description ?? '-'
        ]);
    }
    public function validateRequest(Request $request, $isDataReturned = false) {
        $data = [
            "name" => "required",
            "sellCost" => "required|numeric",
            'buyCost' => "required|numeric",
            'quantity' => "required|numeric"
        ];

        $request->validate($data);

        return $data;
    }
}
