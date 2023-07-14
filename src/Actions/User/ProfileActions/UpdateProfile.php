<?php
namespace Transave\ScolaCvManagement\Actions\User\ProfileActions;

use Transave\ScolaCvManagement\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UpdateProfile
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'first_name' => ['string', 'max:225'],
            'last_name' => ['string', 'max:225'],
            'department_id' => ['string', 'exists:departments,id'],
            'faculty_id' => ['string', 'exists:faculties,id'],
            'marital_status' => ['string', 'max:225'],
            'gender' => ['string', 'max:225'],
            'phone' => ['string', 'max:225'],
            'email' => ['string', 'max:225'],
            'school_id' => ['string', 'exists:schools,id'],
            'qualification_id' => ['string', 'exists:qualifications,id'],
            'country_of_origin_id' => ['string', 'exists:countries,id'],
            'country_of_residence_id' => ['string', 'exists:countries,id'],
            'lg_of_residence_id' => ['string', 'exists:lgs,id'],
            'lg_of_origin_id' => ['string', 'exists:lgs,id'],
            'residential_address' => ['string', 'max:225'],
            'permanent_address' => ['string', 'max:225'],
            'dob' => ['string', 'max:225'],
            'no_of_children' => ['string', 'max:225'],


        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $user = User::query()->where('id', $request->id)
                ->update([
                    'first_name' => $request->first_name,
                    'department_id' => $request->department_id,
                    'faculty_id' => $request->faculty_id,
                    'last_name' => $request->last_name,
                    'marital_status' => $request->marital_status,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'school_id' => $request->school_id,
                    'qualification_id' => $request->qualification_id,
                    'country_of_origin_id' => $request->country_of_origin_id,
                    'country_of_residence_id' => $request->country_of_residence_id,
                    'lg_of_residence_id' => $request->lg_of_residence_id,
                    'lg_of_origin_id' => $request->lg_of_origin_id,
                    'residential_address' => $request->residential_address,
                    'permanent_address' => $request->permanent_address,
                    'dob' => $request->dob,
                    'no_of_children' => $request->no_of_children,

                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'User updated successfully',
            ]);

        }
    }
}



