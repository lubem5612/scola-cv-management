<?php


namespace Transave\ScolaCvManagement\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Auth\CreateAccount;
use Transave\ScolaCvManagement\Actions\Auth\LoginAccount;
use Transave\ScolaCvManagement\Actions\Auth\ResendTokenAction;
use Transave\ScolaCvManagement\Actions\Auth\VerifyEmailAction;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    use ResponseHelper;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['user', 'logout']);
    }

    public function register(Request $request)
    {
        return (new CreateAccount($request->except(['picture'])))->execute();
    }

    public function login(Request $request)
    {
        return (new LoginAccount($request->all()))->execute();
    }

    /**
     * fetch authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        try {
            return $this->sendSuccess($request->user(), 'authenticated user retrieved successfully');
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    /**
     * Logout authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return $this->sendSuccess(null, 'user logged out successfully');
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    /**
     * Verify created account
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCbt\Helpers\Response
     */
    public function verifyEmail(Request $request)
    {
        return (new VerifyEmailAction($request->all()))->execute();
    }

    /**
     * Resend account verification token for auth user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCbt\Helpers\Response
     */
    public function resendToken(Request $request)
    {
        return (new ResendTokenAction($request->all()))->execute();
    }
}