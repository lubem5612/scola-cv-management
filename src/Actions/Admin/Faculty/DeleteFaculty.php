<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Faculty;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Faculty;


class DeleteFaculty
{
    public function handle(Request $request){

        $del = Faculty::find($request->id);

        if ($del->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete Faculty",

            ]);
        }
        else {
            $del->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Faculty Deleted Successfully",
            ]);
        }
    }
}
