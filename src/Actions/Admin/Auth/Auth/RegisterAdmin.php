<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Auth;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\User;


class RegisterAdmin
{
    use ValidationHelper, ResponseHelper;
    private $request, $user;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->setUserType()
                ->createAdmin()
                ->buildResponse('created successfully', true, $this->user);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }

    private function setUserType() :self
    {
        if (array_key_exists('user_type', $this->request)) {
            $this->request['user_type'] = 'admin';
        }
        return $this;
    }


    private function createAdmin()
    {
        $inputs = Arr::only($this->request, ['firstName', 'user_type', 'password', 'lastName', 'faculty_id', 'department_id', 'email']);
        $this->user = User::query()->create($inputs);
        if (empty($this->user)) {
            return $this->buildResponse('failed in creating new admin', false, null);
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $this->validate($this->request, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'faculty_id' => ['required', 'string', 'exists:faculty, id'],
            'department_id' => ['required', 'string', 'exists:department, id'],
            'email' => ['required', 'string', 'unique:users', 'email'],
            "user_type" => 'in:user,admin',
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'same:password'],

        ]);

        return $this;
    }
}




