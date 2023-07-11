<?php
namespace Transave\ScolaCvManagement\Actions\User\Publication;

use Transave\ScolaCvManagement\Http\Models\Publications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpdatePublication
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
            $user = Publications::query()->where('id', $request->id)
                ->update([
                    'achievementName' => $request->achievementName,
                    'description' => $request->description,
                    'users_id' => $request->users_id,
                    'dateAchieved' => $request->dateAchieved
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Publication updated successfully',
            ]);

        }
    }
}



