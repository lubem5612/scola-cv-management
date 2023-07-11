<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Achievement;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Achievements;

class ViewUserAchievements
{
    public function handle(Request $request){

        $view= Achievements::all()->where('id', $request->id)->first();

        if($view === null) {
            return response()->json([
                "Status"=>200,
                "message" => "Achievement not found"
            ]);

        }
        else{
            return response()->json([
                "Status"=>200,
                "message" => "Achievement Details",
                "data"=>$view
            ]);

        }
    }
}
