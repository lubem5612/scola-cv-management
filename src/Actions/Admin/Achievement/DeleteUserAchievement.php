<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Achievement;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Achievements;


class DeleteUserAchievement
{
    public function handle(Request $request){

        $achievement = Achievements::find($request->id);

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
