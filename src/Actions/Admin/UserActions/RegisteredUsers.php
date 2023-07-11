<?php
namespace Transave\ScolaCvManagement\Actions\Admin\UserActions;

use Transave\ScolaCvManagement\Http\Models\User;
use Illuminate\Http\Request;


class RegisteredUsers
{
        public function handle(Request $request){
            $data = User::all();
            return response()->json([
                'Status'=>200,
                'message'=>"List of Registered Users",
               'data' =>$data
            ]);
        }
}
