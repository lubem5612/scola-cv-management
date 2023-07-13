<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Achievement;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Illuminate\Http\Request;


class RegisteredAchievements
{
    public function handle(Request $request){

        $list = Achievement::all();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Achievements",
            'data' =>$list
        ]);
    }
}
