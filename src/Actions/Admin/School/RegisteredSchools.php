<?php
namespace Transave\ScolaCvManagement\Actions\Admin\School;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\School;

class  RegisteredSchools
{
    public function handle(Request $request)
    {
        $data = School::all();
        return response()->json([
            'status'=>200,
            'message'=>"List of Registered School",
            'data' =>$data
        ]);

    }
}
