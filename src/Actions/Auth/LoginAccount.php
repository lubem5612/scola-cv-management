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
                ->setUsername()
                ->authenticateUser();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function authenticateUser()
    {
        $isAuth = auth()->guard('api')->attempt([$this->username => $this->validatedInput['email'], 'password' => $this->validatedInput['password']]);
        if ($isAuth) {
            $user = auth()->guard('api')->user();
            $user['token'] = auth()->guard('api')->user()->createToken(uniqid())->plainTextToken;
            return $this->sendSuccess($user, 'login successful');
        }
        return $this->sendError('authentication failed', [], 401);
    }

    private function setUsername()
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
        $this->validatedInput = $this->validate($this->data, [
            'email' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'max:60']
        ]);

        return $this;
    }
}

