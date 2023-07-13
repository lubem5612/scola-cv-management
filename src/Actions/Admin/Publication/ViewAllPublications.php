<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Publication;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Publication;
use Illuminate\Http\Request;


class ViewAllPublications
{
    public function handle(Request $request){

        $request = Publication::all()->where('user_id', $request->user_id)->first();
        return response()->json([
            'Status'=>200,
            'message'=>"List of User Achievements",
            'data' =>$request
        ]);
    }
}
