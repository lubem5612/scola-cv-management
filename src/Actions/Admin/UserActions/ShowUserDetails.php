<?php
namespace Transave\ScolaCvManagement\Actions\Admin\UserActions;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\User;

class ShowUserDetails
{
    public function handle(Request $request){

        $user = User::all()->where('id', $request->id)->first();

        if($user === null) {
            return response()->json([
                "Status"=>200,
                "message" => "User not found",
            ]);

        }
        else{
            return response()->json([
                "Status"=>200,
                "message" => "User Information",
                "data"=>$user,
            ]);

        }
    }
}
