<?php
namespace Transave\ScolaCvManagement\Actions\User\EducationalQualification;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Illuminate\Http\Request;

class AddQualification
{
    public function handle(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'string', 'exists:users,id'],
            'institutionName' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'string', 'exists:department,id'],
            'courseStudy' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'string', 'max:255'],
            'endDate' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255']

        ]);

        if($validator->fails()){
            return response()->json([
                'Status'=>400,
                'data'=>[],
                'message' => $validator->errors()
            ]);

        }

        $input = $request->all();
        $qualification = Achievement::create($input);
        $success['user_id'] =  $qualification->user_id;
        $success['institutionName'] =  $qualification->institutionName;
        $success['department_id'] = $qualification->department_id;
        $success['courseStudy'] =  $qualification->courseStudy;
        $success['startDate'] =  $qualification->startDate;
        $success['endDate'] = $qualification->endDate;
        $success['country'] =  $qualification->country;

        return response()->json([
            'Status'=>200,
            'Message' => 'Successfully registered',
            'data'=>$success,
        ]);

    }
}
