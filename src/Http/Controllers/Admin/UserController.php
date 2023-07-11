<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\UserActions\DeleteUser;
use Transave\ScolaCvManagement\Actions\Admin\UserActions\RegisteredUsers;
use Transave\ScolaCvManagement\Actions\Admin\UserActions\ShowUserDetails;
use Transave\ScolaCvManagement\Actions\Admin\UserActions\UpdateUser;


class UserController extends Controller
{

    /**
     * Register a new School
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */


    // Delete User
    public function delUser(Request $request, DeleteUser $deleteUser)
    {
        $delete = $deleteUser->handle($request);
        return $delete;
    }



    // view all Users Registered
    public function viewUsers(Request $request, RegisteredUsers $registeredUsers)
    {
        $all = $registeredUsers->handle($request);
        return $all;
    }


    // Update User Registered
    public function editUser(Request $request, UpdateUser $updateUser)
    {
        $update = $updateUser->handle($request);
        return $update;
    }


    // How User Details
    public function viewUserInfo(Request $request, ShowUserDetails $showUserDetails)
    {
        $update = $showUserDetails->handle($request);
        return $update;
    }

}
