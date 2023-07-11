<?php
namespace Transave\ScolaCvManagement\Actions\Admin\WorkExperience;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;


class DeleteUserWorkExperience
{
    public function handle(Request $request){

        $experience = WorkExperience::find($request->id);

        if ($experience->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete the Work Experience",

            ]);
        }
        else {
            $experience->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Work Experience Deleted Successfully",
            ]);
        }
    }
}
