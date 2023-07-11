<?php
namespace Transave\ScolaCvManagement\Actions\User\Publication;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Publications;


class DeletePublication
{
    public function handle(Request $request){

        $publication = Publications::find($request->id);

        if ($publication->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete the Publication",

            ]);
        }
        else {
            $publication->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Publication Deleted Succesffully",
            ]);
        }
    }
}
