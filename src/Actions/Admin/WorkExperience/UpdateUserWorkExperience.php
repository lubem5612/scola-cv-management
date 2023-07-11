<?php
namespace Transave\ScolaCvManagement\Actions\Admin\WorkExperience;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;


class UpdateUserWorkExperience
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'achievementName' => ['required', 'string', 'max:255'],
            'dateAchieved' => ['string', 'max:255'],
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
            $user = WorkExperience::query()->where('id', $request->id)
                ->update([
                    $success['companyName'] =  $request->companyName,
                    $success['position'] =  $request->position,
                    $success['user_id'] = $request->user_id,
                    $success['responsibilities'] =  $request->responsibilities,
                    $success['startDate'] =  $request->startDate,
                    $success['endDate'] =  $request->endDate
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'User Publication updated',
            ]);

        }
    }
}



