<?php
namespace Transave\ScolaCvManagement\Actions\User\Achievement;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievements;
use Illuminate\Http\Request;

class CreateAchievement
{
    public function handle(Request $request){

        $validator = Validator::make($request->all(), [
            'achievementName' => ['string', 'max:255'],
            'dateAchieved' => ['string', 'max:255'],
            'user_id' => ['max:255', 'exists:users,id'],
            'description' => ['string', 'max:255']
        ]);

        if($validator->fails()){
            return response()->json([
                'Status'=>400,
                'data'=>[],
                'message' => $validator->errors()
            ]);

        }


            $input = $request->all();
            $achievement = Achievements::create($input);
            $success['achievementName'] =  $achievement->achievementName;
            $success['dateAchieved'] =  $achievement->dateAchieved;
            $success['user_id'] = $achievement->user_id;

            return response()->json([
                'Status'=>200,
                'Message' => 'Successfully registered',
                'Token'=>$success,
            ]);

        }
}
