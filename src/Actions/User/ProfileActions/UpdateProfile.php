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
            'firstName' => 'string',
            'lastName' => 'string',
            'faculty_id' => 'exists:faculty,id',
            'department_id' => 'exists:department,id',
            'email' => 'string',
            'phone' => 'string|max:255',
            'gender' => 'string',
            'marital_status' => 'string',
            'nationality' => 'string|max:200',
            'lga' => 'string|max:200',
            'state_of_resident' => 'string|max:255',
            'residential_address' => 'string|max:255',
            'permanent_address' => 'string|max:255',
            'dob' => 'string|max:200',
            'no_of_children' => 'string|max:50',

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
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'department' => $request->department,
                    'faculty' => $request->faculty,
                    'password' => Hash::make($request->password),
                ]);
            return response()->json([
                'Status' => 200,
                'message' => 'User updated successfully',
            ]);

        }
    }
}



