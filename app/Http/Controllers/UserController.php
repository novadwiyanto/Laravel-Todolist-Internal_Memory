<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return response()->view("user.login", [
            "title" => 'Login'
        ]);

    }

    public function dologin(Request $request) : Response|RedirectResponse {
        $user = $request->input('user'); 
        $password = $request->input('password'); 

        if (empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "User and Password is Required"
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect('/');
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "User or Password is Wrong"
        ]);
    }

    function dologout(Request $request) : RedirectResponse {
        $request->session()->forget("user");
        return redirect('/login');
    }
}
