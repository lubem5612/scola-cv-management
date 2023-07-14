<?php
namespace Transave\ScolaCvManagement\Actions\Auth;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;


class LoginAccount
{
    use ResponseHelper, ValidationHelper;
    private $data;
    private $username;
    private $validatedInput;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function execute()
    {
        try {
            return $this
                ->validateLoginData()
                ->username()
                ->authenticateUser();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function authenticateUser()
    {
        $isAuth = auth()->guard('api')->attempt([$this->username => $this->data['email'], 'password' => $this->data['password']]);
        if ($isAuth) {
            $token = auth()->guard('api')->user()->createToken(uniqid())->plainTextToken;
            return $this->sendSuccess($token, 'login successful');
        }
        return $this->sendError('authentication failed', [], 401);
    }

    private function username()
    {
        if(filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->username = 'email';
        }
        else {
            $this->username = 'phone';
        }
        return $this;
    }

    private function validateLoginData()
    {
        $validator = $this->validate($this->data, [
            'email' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string']
        ]);
        $this->validatedInput = $validator;
        return $this;
    }
}

