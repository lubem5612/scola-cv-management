<?php
namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\User\ProfileActions\UpdateProfile;
use Transave\ScolaCvManagement\Actions\User\ProfileActions\ViewProfile;
use Transave\ScolaCvManagement\Actions\User\ProfileActions\ChangePassword;



class UserProfileController extends Controller
{

    // Update Profile
    public function edit(Request $request, UpdateProfile $updateProfile)
    {
        $update = $updateProfile->handle($request);
        return $update;
    }


    // View PROFILE
    public function view(Request $request, ViewProfile $viewProfile)
    {
        $view = $viewProfile->handle($request);
        return $view;
    }

    // Update Password
    public function editPassword(Request $request, ChangePassword $changePassword)
    {
        $change = $changePassword->handle($request);
        return $change;
    }
}
