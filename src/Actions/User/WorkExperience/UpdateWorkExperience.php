<?php
namespace Transave\ScolaCvManagement\Actions\User\WorkExperience;

use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateWorkExperience
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'companyName' => ['string', 'max:255'],
            'position' => ['string', 'max:255'],
            'responsibilities' => ['string', 'max:255'],
            'startDate' => 'string',
            'endDate' => 'string'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $update = WorkExperience::query()->where('id', $request->id)
                ->update([
                    'companyName' => $request->companyName,
                    'position' => $request->position,
                    'responsibilities' => $request->responsibilities,
                     'startDate' => $request->startDate,
                    'endDate' => $request->endDate
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Work Experience updated successfully',
            ]);

        }
    }
}



