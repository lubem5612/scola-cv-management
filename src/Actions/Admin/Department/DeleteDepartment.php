<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Department;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Department;


class DeleteDepartment
{
    public function handle(Request $request){

        $del = Department::find($request->id);

        if ($del->delete() === false) {
            return response()->json([
                "code"=>400,
                "status"=> false,
                "message" => "Couldn't delete DepartmentController",

            ]);
        }
        else {
            $del->delete();
            return response()->json([
                "code" => 200,
                "status" => true,
                "message" => "DepartmentController Deleted Successfully",
            ]);
        }
    }
}
