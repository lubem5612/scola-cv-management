<?php


namespace Transave\ScolaCvManagement\Actions\Auth;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;

class ChangeEmailAction
{
    use ResponseHelper, ValidationHelper;
    private $request, $validatedInput;
    private $user;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->setUser()
                ->updateEmail();
        } catch (\Exception $exception) {
            return $this->sendServerError($exception);
        }
    }

    private function setUser()
    {
        $this->user = config('scolacv.auth_model')::query()->find($this->validatedInput['user_id']);
        return $this;
    }

    private function updateEmail()
    {
        $this->user->update([
            'email' => $this->validatedInput['email']
        ]);
        return $this->sendSuccess($this->user->refresh(), 'Email updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'email' => 'required|email|unique:users,email',
            'user_id' => 'required|exists:users,id'
        ]);
        return $this;
    }
}