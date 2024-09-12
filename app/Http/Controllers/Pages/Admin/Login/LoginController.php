<?php

namespace App\Http\Controllers\Pages\Admin\Login;

use App\Http\Controllers\Templates\BaseLoginController;
use Illuminate\Http\Request;

class LoginController extends BaseLoginController
{
    protected $viewPath = "admin.login";
    protected array $desiredFields = array("username", "password");
    protected $guardName = "admin";

    public function handleValidation(Request $request) {
        $request->validate([
            "username"=> "required",
            "password" => "required"
        ]);
    }
}
