<?php
namespace Transave\ScolaCvManagement\Actions\Admin\School;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Schools;


class DeleteSchool
{
    public function handle(Request $request){

        $del = Schools::find($request->id);

        if ($del->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete School",

            ]);
        }
        else {
            $del->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "School Deleted Successfully",
            ]);
        }
    }
}
