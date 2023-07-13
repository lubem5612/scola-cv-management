<?php
namespace Transave\ScolaCvManagement\Actions\User\Achievement;

use Transave\ScolaCvManagement\Http\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateAchievement
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
            $update = Achievement::query()->where('id', $request->id)
                ->update([
                    'achievementName' => $request->achievementName,
                    'description' => $request->description,
                    'dateAchieved' => $request->dateAchieved
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Achievement updated successfully',
            ]);

        }
    }
}



