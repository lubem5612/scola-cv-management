<?php
namespace Transave\ScolaCvManagement\Actions\Admin\UserActions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\User;


class UpdateUser
{
    public function handle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'email' => ['string', 'unique:user', 'email'],
            'password' => ['string', 'max:255'],
            'password_confirmation' => ['string', 'same:password'],
            'phone' => ['string', 'max:255'],
            'gender' => ['string', 'max:255'],
            'marital_status' => ['string', 'max:255'],
            'nationality' => ['string', 'max:255'],
            'lga' => ['string', 'max:255'],
            'state_of_resident' => ['string', 'max:255'],
            'residential_address' => ['string', 'max:255'],
            'permanent_address' => ['string', 'max:255'],
            'dob' => ['string', 'max:255'],
            'no_of_children' => ['string', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Status' => 400,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $profile = User::all()->where('id', $request->id)
                ->update([
                    'firstName' => $request->get('firstName'),
                    'password' => bcrypt($request->password),
                    'lastName' => $request->get('lastName'),
                    'email' => $request->get('email'),
                    'gender' => $request->get('gender'),
                    'phone' => $request->get('phone'),
                    'marital_status' => $request->get('marital_status'),
                    'nationality' => $request->get('nationality'),
                    'state_of_resident' => $request->get('state_of_resident'),
                    'lga' => $request->get('lga'),
                    'residential_address' => $request->get('residential_address'),
                    'permanent_address' => $request->get('permanent_address'),
                    'dob' => $request->get('dob'),
                    'no_of_children' => $request->get('no_of_children')
                ]);

            return response()->json([
                'Status' => 200,
                'message' => 'User updated successfully',
                'profile' => $profile
            ]);
        }
    }
}

