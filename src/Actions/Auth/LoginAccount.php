<?php
namespace Transave\ScolaCvManagement\Actions\Auth;

use Transave\ScolaCvManagement\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;


class LoginAccount
{
    public function handle(Request $request){

        //validation
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'data' => [],
                'Status'=>400,
                'message' => $validator->errors(),
            ]);

        }

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
                $success['firstName'] =  $user->firstName;
                $success['lastName'] =  $user->lastName;
                $success['email'] =  $user->email;

                return response()->json([
                    'Status'=>200,
                    'Message'=> 'Login successfully',
                    'data'=>$success
                ]);
            }
            else{
                return response()->json([
                    'Status'=>400,
                    'Message'=> 'Password Incorrect, try again',
                ]);
            }
        }
        else{
            return response()->json([
                'data' => [],
                'Status'=>200,
                'Message'=> 'This Email is not registered',
            ]);
        }
    }
}

