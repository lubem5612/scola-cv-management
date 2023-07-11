<?php
namespace Transave\ScolaCvManagement\Actions\User\Specialization;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Illuminate\Http\Request;


class ViewAllSpecialization
{
    public function handle(Request $request){

        $request = Specialization::all()->where('user_id', $request->user_id)->first();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Specializations",
            'data' =>$request
        ]);
    }
}
