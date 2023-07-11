<?php
namespace Transave\ScolaCvManagement\Actions\Admin\School;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Schools;

class  RegisteredSchools
{
    public function handle(Request $request)
    {
        $data = Schools::all();
        return response()->json([
            'status'=>200,
            'message'=>"List of Registered Schools",
            'data' =>$data
        ]);

    }
}
