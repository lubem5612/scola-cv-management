<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Achievement;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievements;
use Illuminate\Http\Request;


class RegisteredAchievements
{
    public function handle(Request $request){

        $list = Achievements::all();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Achievements",
            'data' =>$list
        ]);
    }
}
