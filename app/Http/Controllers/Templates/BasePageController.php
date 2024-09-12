<?php

namespace App\Http\Controllers\Templates;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;

abstract class BasePageController extends Controller
{
    protected $viewPath;

    public function index($extraData = []) {
        if(isset($extraData)) {
            return view("content.".$this->viewPath, [...$extraData]);
        }
        return view("content.".$this->viewPath);
    }
}
