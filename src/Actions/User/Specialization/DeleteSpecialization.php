<?php
namespace Transave\ScolaCvManagement\Actions\User\Specialization;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Specialization;


class DeleteSpecialization
{
    public function handle(Request $request){

        $specialization= Specialization::find($request->id);

        if ($specialization->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete the Publication",

            ]);
        }
        else {
            $specialization->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "Specialization Deleted Successfully",
            ]);
        }
    }
}
