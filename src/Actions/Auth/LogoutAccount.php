<?php
namespace Transave\ScolaCvManagement\Actions\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogoutAccount
{
    public function handle(Request $request){
            Session::flush();
            Auth::logout();

        return response()->json([
            'Status' => 200,
            'Message' => 'Logout successfully',
        ]);
    }
}
