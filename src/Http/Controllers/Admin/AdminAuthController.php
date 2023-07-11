<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\Auth\CreateUserAccount;
use Transave\ScolaCvManagement\Actions\Admin\Auth\RegisterAdmin;

class AdminAuthController extends Controller
{

    // Create user
    /**
     * Register a new Achievement
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerUser(Request $request)
    {
        return (new CreateUserAccount($request->all()))->execute();
    }


    // Create admin

    /**
     * register User admin
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerAdmin(Request $request)
    {
        return (new RegisterAdmin($request->all()))->execute();
    }
}


