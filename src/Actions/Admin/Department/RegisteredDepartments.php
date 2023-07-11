<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Department;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Department;

class  RegisteredDepartments
{
    public function handle(Request $request)
    {
        $data['dept'] = Department::all();
        return response()->json([
            'status'=>200,
            'message'=>"List of Registered Departments",
            'data' =>$data
        ]);

    }
}
