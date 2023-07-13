<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Qualifications;

use Transave\ScolaCvManagement\Http\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EditRegisteredQualification
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qualification' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $update = Qualification::query()->where('id', $request->id)
                ->update([
                    'qualification' => $request->qualification
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Qualification updated successfully',
            ]);

        }
    }
}



