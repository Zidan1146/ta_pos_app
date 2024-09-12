<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Templates\BasePageController;
use Illuminate\Http\Request;

class IndexController extends BasePageController
{
    protected $viewPath = "main";
}
