<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Auth\CreateAccount;
use Transave\ScolaCvManagement\Http\Models\User;

class RegisterNewAccountController extends Controller
{

    public function register(Request $request)
    {
        return (new CreateAccount($request->all()))->execute();
    }
}
