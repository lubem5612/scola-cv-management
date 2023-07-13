<?php
namespace Transave\ScolaCvManagement\Actions\User\Publication;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Illuminate\Http\Request;

class CreatePublication
{
    public function handle(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => ['max:255', 'exists:users,id'],
            'publication' => ['string', 'max:255']
        ]);

        if($validator->fails()){
            return response()->json([
                'Status'=>400,
                'data'=>[],
                'message' => $validator->errors()
            ]);

        }

            $input = $request->all();
            $query = Achievement::create($input);
            $success['publication'] =  $query->publication;
            $success['user_id'] = $query->user_id;

            return response()->json([
                'Status'=>200,
                'Message' => 'Successfully Created',
                'Token'=>$success
            ]);

        }
}
