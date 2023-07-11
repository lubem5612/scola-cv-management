<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Qualifications;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Qualifications;


class DeleteRegisteredQualification
{
    public function handle(Request $request){

        $query = Qualifications::find($request->id);

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
