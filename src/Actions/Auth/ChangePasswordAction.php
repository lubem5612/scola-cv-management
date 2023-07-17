<?php


namespace Transave\ScolaCvManagement\Actions\Auth;


use Illuminate\Support\Facades\Hash;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;

class ChangePasswordAction
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
                ->changePassword();
        } catch (\Exception $exception) {
            return $this->sendServerError($exception);
        }
    }

    private function setUser()
    {
        $this->user = config('scolacv.auth_model')::query()->find($this->validatedInput['user_id']);
        return $this;
    }

    private function changePassword()
    {
        if (Hash::check($this->validatedInput['old_password'], $this->user->password)) {
            $this->user->password = bcrypt($this->validatedInput['new_password']);
            $this->user->save();
            return $this->sendSuccess($this->user->refresh(), 'Password changed successfully');
        }
        return $this->sendError('password did not match existing one', [], 403);
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'new_password' => 'required|string|min:6',
            'old_password' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);
        return $this;
    }
}