<?php
namespace Transave\ScolaCvManagement\Actions\Admin\UserActions;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\User;


class DeleteUser
{
    public function handle(Request $request){

        $user = User::find($request->id);

        if ($user === null) {
            return response()->json([
                "status"=>200,
                "message" => "User with id {$request->id} not found",
            ]);

        }

        if ($user->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete the user with id {$request->id}",

            ]);
        }
        else {
            $user->delete()->first();
            return response()->json([
                "code" => 200,
                "status" => true,
                "id" => $request->id,
                "message" => "User Deleted Succesffully",
            ]);
        }
    }
}
