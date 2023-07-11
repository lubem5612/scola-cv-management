<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Department;

use Transave\ScolaCvManagement\Http\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateDepartment
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $update = Department::query()->where('id', $request->id)
                ->update([
                    'name' => $request->name
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Deparment updated successfully',
            ]);

        }
    }
}



