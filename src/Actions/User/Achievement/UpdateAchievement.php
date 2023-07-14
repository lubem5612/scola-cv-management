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
            'cv_id' => ['string', 'max:255', 'exists:cvs, id'],
            'title' => ['string', 'max:255'],
            'date_achieved' => ['string', 'max:255'],
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
                    'cv_id' => $request->cv_id,
                    'title' => $request->title,
                    'date_achieved' => $request->date_achieved,
                    'description' => $request->description
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'Achievement updated successfully',
            ]);

        }
    }
}



