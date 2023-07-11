<?php
namespace Transave\ScolaCvManagement\Actions\User\EducationalQualification;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\EducationalQualification;
use Illuminate\Http\Request;


class ViewAllQualifications
{
    public function handle(Request $request){

        $list = EducationalQualification::all()->where('user_id', $request->user_id)->first();
        return response()->json([
            'Status'=>200,
            'message'=>"List of Registered Qualifications",
            'data' =>$list
        ]);
    }
}
