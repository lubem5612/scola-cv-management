<?php
namespace Transave\ScolaCvManagement\Actions\User\WorkExperience;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Illuminate\Http\Request;


class ViewAllWorkExperience
{
    public function handle(Request $request){

        $list = WorkExperience::all()->where('user_id', $request->user_id)->first();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Work Experience",
            'data' =>$list
        ]);
    }
}
