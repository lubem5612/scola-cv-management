<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Specialization;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Illuminate\Http\Request;


class RegisteredSpecializations
{
    public function handle(Request $request){

        $request = Specialization::all();
        return response()->json([
            'Status'=>200,
            'message'=>"List of All Users Specializations",
            'data' =>$request
        ]);
    }
}
