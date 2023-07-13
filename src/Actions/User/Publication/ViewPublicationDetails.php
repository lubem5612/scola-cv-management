<?php
namespace Transave\ScolaCvManagement\Actions\User\Publication;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Publication;

class ViewPublicationDetails
{
    public function handle(Request $request){

        $user = Publication::all()->where('id', $request->id)->first();

        if($user === null) {
            return response()->json([
                "Status"=>200,
                "message" => "Publication not found"
            ]);

        }
        else{
            return response()->json([
                "Status"=>200,
                "message" => "Publication Details",
                "data"=>$user
            ]);

        }
    }
}
