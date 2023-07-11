<?php
namespace Transave\ScolaCvManagement\Actions\User\ProfileActions;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\User;

class ViewProfile
{
    public function handle(Request $request){

        $user = User::all()->where('id', $request->id)->first();

        if($user === null) {
            return response()->json([
                "Status"=>200,
                "message" => "User not found"
            ]);

        }
        else{
            return response()->json([
                "Status"=>200,
                "message" => "Profile Information",
                "data"=>$user
            ]);

        }
    }
    }
