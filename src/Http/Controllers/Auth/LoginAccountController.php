<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Auth\LoginAccount;

class LoginAccountController extends Controller
{
    // Login Profile
    public function login(Request $request, LoginAccount $loginAccount)
    {
        $login = $loginAccount->handle($request);
        return $login;
    }
}
