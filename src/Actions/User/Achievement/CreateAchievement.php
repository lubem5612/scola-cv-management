<?php
namespace Transave\ScolaCvManagement\Actions\User\Achievement;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Illuminate\Http\Request;

class CreateAchievement
{
    public function handle(Request $request){

        $validator = Validator::make($request->all(), [
            'cv_id' => ['string', 'max:255', 'exists:cvs, id'],
            'title' => ['string', 'max:255'],
            'date_achieved' => ['string', 'max:255'],
            'user_id' => ['string', 'exists:users, id'],
            'description' => ['string', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json([
                'Status'=>400,
                'data'=>[],
                'message' => $validator->errors()
            ]);

        }


            $input = $request->all();
            $achievement = Achievement::create($input);
            $success['cv_id'] =  $achievement->cv_id;
            $success['title'] =  $achievement->title;
            $success['date_achieved'] = $achievement->date_achieved;
            $success['user_id'] = $achievement->user_id;
            $success['description'] = $achievement->description;

            return response()->json([
                'Status'=>200,
                'Message' => 'Successfully registered',
                'Token'=>$success,
            ]);

        }
}
