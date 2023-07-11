<?php
namespace Transave\ScolaCvManagement\Actions\Admin\School;

use Transave\ScolaCvManagement\Http\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Schools;


class UpdateSchool
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
            $update = Schools::query()->where('id', $request->id)
                ->update([
                    'name' => $request->name
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'School updated successfully',
            ]);

        }
    }
}



