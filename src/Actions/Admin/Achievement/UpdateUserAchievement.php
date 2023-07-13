<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Achievement;

use Transave\ScolaCvManagement\Http\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdateUserAchievement
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'achievementName' => ['string', 'max:255'],
            'dateAchieved' => ['string', 'max:255'],
            'user_id' => ['string', 'exist:users, id'],
            'description' => ['string', 'max:255'],
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
            'dateAchieved' => $request->dateAchieved,
            'user_id' => $request->user_id,
            'description' => $request->description,
                ]);

            return response()->json([
                'Status' => 200,
                'message' => 'Acievement updated successfully',
            ]);

        }
    }
}



