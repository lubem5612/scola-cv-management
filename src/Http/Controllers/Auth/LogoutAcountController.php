<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Auth\LogoutAccount;

class LogoutAcountController extends Controller
{
    // Logout Profile
    public function logout(Request $request, LogoutAccount $logoutAccount)
    {
        $logout = $logoutAccount->handle($request);
        return $logout;
    }
}
