<?php
namespace Transave\ScolaCvManagement\Actions\User\EducationalQualification;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\EducationalQualification;


class DeleteQualification
{
    public function handle(Request $request){

        $query = EducationalQualification::find($request->id);

        if ($query->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete Qualification",

            ]);
        }
        else {
            $query->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Qualification Deleted",
            ]);
        }
    }
}
