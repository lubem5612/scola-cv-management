<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Faculty;

use Transave\ScolaCvManagement\Http\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateFaculty
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => ['string', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $update = Faculty::query()->where('id', $request->id)
                ->update([
                    'name' => $request->name
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Faculty updated successfully',
            ]);

        }
    }
}



