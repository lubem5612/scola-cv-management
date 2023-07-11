<?php
namespace Transave\ScolaCvManagement\Actions\User\WorkExperience;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Illuminate\Http\Request;

class CreateWorkExperience
{
    public function handle(Request $request){

        $validator = Validator::make($request->all(), [
            'companyName' => ['string', 'max:255'],
            'position' => ['string', 'max:255'],
            'user_id' => ['max:255', 'exists:users,id'],
            'responsibilities' => ['string', 'max:255'],
            'startDate' => 'string',
            'endDate' => 'string'
        ]);

        if($validator->fails()){
            return response()->json([
                'Status'=>400,
                'data'=>[],
                'message' => $validator->errors()
            ]);

        }

        $input = $request->all();
        $achievement = WorkExperience::create($input);
        $success['companyName'] =  $achievement->companyName;
        $success['position'] =  $achievement->position;
        $success['user_id'] = $achievement->user_id;
        $success['responsibilities'] =  $achievement->responsibilities;
        $success['startDate'] =  $achievement->startDate;
        $success['endDate'] =  $achievement->endDate;

        return response()->json([
            'Status'=>200,
            'Message' => 'Successfully Added',
            'Token'=>$success,
        ]);

    }
}
