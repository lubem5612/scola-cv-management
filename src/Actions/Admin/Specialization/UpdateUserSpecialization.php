<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Specialization;

use Transave\ScolaCvManagement\Http\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateUserSpecialization
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['string', 'max:255'],
            'description' => ['string', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $user = Specialization::query()->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Specialization updated successfully',
            ]);

        }
    }
}



