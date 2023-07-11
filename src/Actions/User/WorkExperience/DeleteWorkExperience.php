<?php
namespace Transave\ScolaCvManagement\Actions\User\WorkExperience;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;


class DeleteWorkExperience
{
    public function handle(Request $request){

        $query = WorkExperience::find($request->id);

        if ($query->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete your Work Experience",

            ]);
        }
        else {
            $query->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Work Experience Deleted",
            ]);
        }
    }
}
