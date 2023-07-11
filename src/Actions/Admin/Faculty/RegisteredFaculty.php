<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Faculty;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Faculty;

class  RegisteredFaculty
{
    public function handle(Request $request)
    {
        $data = Faculty::all();
        return response()->json([
            'status'=>200,
            'message'=>"List of Registered Faculty",
            'data' =>$data
        ]);

    }
}
