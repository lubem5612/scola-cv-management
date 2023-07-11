<?php
namespace Transave\ScolaCvManagement\Actions\User\Achievement;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievements;
use Illuminate\Http\Request;


class ViewAllAchievement
{
    public function handle(Request $request){

        $list = Achievements::all()->where('user_id', $request->user_id)->first();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Achievements",
            'data' =>$list
        ]);
    }
}
