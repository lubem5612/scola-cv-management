<?php


namespace Transave\ScolaCvManagement\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Auth\CreateAccount;
use Transave\ScolaCvManagement\Actions\Auth\LoginAccount;
use Transave\ScolaCvManagement\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        return (new CreateAccount($request->except(['picture'])))->execute();
    }

    public function login(Request $request)
    {
        return (new LoginAccount($request->all()))->execute();
    }
}