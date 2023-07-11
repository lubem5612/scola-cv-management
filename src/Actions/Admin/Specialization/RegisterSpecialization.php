<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Specialization;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Illuminate\Http\Request;

class RegisterSpecialization
{
    public function handle(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => ['max:255', 'exists:users,id'],
            'name' => ['string', 'max:255'],
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
        $query = Specialization::create($input);
        $success['description'] =  $query->description;
        $success['name'] =  $query->name;
        $success['user_id'] = $query->user_id;

        return response()->json([
            'Status'=>200,
            'Message' => 'Successfully Added',
            'data'=>$success
        ]);

    }
}
