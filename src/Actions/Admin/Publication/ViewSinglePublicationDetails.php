<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Publication;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Publication;

class ViewSinglePublicationDetails
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
                "message" => "User Publication Details",
                "data"=>$user
            ]);

        }
    }
}
