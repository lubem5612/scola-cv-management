<?php
namespace Transave\ScolaCvManagement\Actions\User\ProfileActions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Http\Models\User;


class ChangePassword
{
    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'max:255'],
            'password_confirmation' => ['required', 'string', 'same:password']

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
                    'password' => bcrypt($request->password),
                ]);

            return response()->json([
                'Status' => 200,
                'message' => 'Password Change successfully',
            ]);
        }
    }
}

