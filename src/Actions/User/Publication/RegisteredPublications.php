<?php
namespace Transave\ScolaCvManagement\Actions\User\Publication;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Publications;
use Illuminate\Http\Request;


class RegisteredPublications
{
    public function handle(Request $request){

        $request = Publications::all()->where('user_id', $request->user_id)->first();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Achievements",
            'data' =>$request
        ]);
    }
}
