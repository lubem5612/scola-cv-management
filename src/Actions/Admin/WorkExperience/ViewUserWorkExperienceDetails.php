<?php
namespace Transave\ScolaCvManagement\Actions\Admin\WorkExperience;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;

class ViewUserWorkExperienceDetails
{
    public function handle(Request $request){

        $view= WorkExperience::all()->where('user_id', $request->user_id)->first();

        if($view === null) {
            return response()->json([
                "Status"=>200,
                "message" => "Work Experience not found"
            ]);

        }
        else{
            return response()->json([
                "Status"=>200,
                "message" => "Work Experience Details",
                "data"=>$view
            ]);

        }
    }
}
