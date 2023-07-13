<?php
namespace Transave\ScolaCvManagement\Actions\User\Achievement;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Achievement;


class DeleteAchievement
{
    public function handle(Request $request){

        $achievement = Achievement::find($request->id);

        if ($achievement->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete the Achievement",

            ]);
        }
        else {
            $achievement->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Achievement Deleted Successfully",
            ]);
        }
    }
}
