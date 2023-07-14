<?php
namespace Transave\ScolaCvManagement\Actions\Auth;


use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\User;

class CreateAccount
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
                ->handle()
                ->setUserPassword()
                ->setVerificationToken()
                ->createUser()
                ->buildResponse('created successfully', true, $this->user);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }

    private function setUserPassword() : self
    {
        $this->request['password'] = bcrypt($this->request['password']);
        return $this;
    }


    private function createUser()
    {
        $inputs = Arr::only($this->request, ['email', 'password', 'firstName', 'lastName', 'faculty_id', 'department_id', 'user_type', 'password']);
        $this->user = User::query()->create($inputs);
        if (empty($this->user)) {
            return $this->buildResponse('failed in creating user', false, null);
        }
        return $this;
    }


    private function setVerificationToken() : self
    {
        $this->request['token'] = rand(100000, 999999);
        $this->request['email_verified_at'] = Carbon::now();
        return $this;
    }

    public function handle(): self
    {
        $this->validate($this->request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'faculty_id' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:user', 'email'],
            'user_type' => ['string', 'max:225'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        return $this;
    }
}
