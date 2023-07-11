<?php
namespace Transave\ScolaCvManagement\Actions\User\EducationalQualification;

use Transave\ScolaCvManagement\Http\Models\EducationalQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateQualification
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institutionName' => ['string', 'max:255'],
            'department_id' => ['string', 'exists:department,id'],
            'courseStudy' => ['string', 'max:255'],
            'startDate' => ['string', 'max:255'],
            'endDate' => ['string', 'max:255'],
            'country' => ['string', 'max:255']

        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $qualification = EducationalQualification::query()->where('id', $request->id)
                ->update([
                    'institutionName' => $request->institutionName,
                    'department_id' => $request->department_id,
                    'courseStudy' => $request->courseStudy,
                    'startDate' => $request->startDate,
                    'endDate' => $request->endDate,
                    'country' => $request->country
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Qualification updated successfully',
            ]);
        }
    }
}



