<?php

namespace App\Http\Controllers\Templates;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class BaseLoginController extends BasePageController
{
    protected $viewPath;
    protected array $desiredFields;
    protected $redirectTo;
    protected $guardName;
    public function login(Request $request, Closure $errorHandler) {
        $this->handleValidation($request);

        $credentials = $request->only($this->desiredFields);

        if(!Auth::guard($this->guardName)->attempt($credentials)) {
            return $this->handleLoginFailure($errorHandler);
        }
        return redirect()->intended($this->redirectTo);
    }

    private function handleLoginFailure(Closure $errorHandler) {
        $message = "Invalid Credentials";

        if($errorHandler) {
            $errorHandler();
        }

        return back()->withErrors("error", $message);
    }

    public function logout() {
        Auth::guard($this->guardName)->logout();
        return redirect(route("index"));
    }

    protected abstract function handleValidation(Request $request);

}
