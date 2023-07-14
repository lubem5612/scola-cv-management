<?php
namespace Transave\ScolaCvManagement\Actions\Auth;


use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Transave\ScolaCvManagement\Helpers\FileUploadHelper;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\User;
use Transave\ScolaCvManagement\Http\Notifications\WelcomeNotification;

class CreateAccount
{

    use ValidationHelper, ResponseHelper;
    private array $request;
    private array $validatedInput;
    private $user;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->setUserPassword()
                ->uploadPhoto()
                ->setVerificationToken()
                ->createUser()
                ->sendNotification()
                ->sendSuccess($this->user, 'account created successfully');
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }

    private function setUserPassword() : self
    {
        $this->validatedInput['password'] = bcrypt($this->validatedInput['password']);
        return $this;
    }

    private function createUser() : self
    {
        $this->user = User::query()->create($this->validatedInput);
        return $this;
    }

    private function setUserType() : self
    {
        if (!array_key_exists('user_type', $this->validatedInput))
        {
            $this->validatedInput['user_type'] = 'user';
        }
        return $this;
    }

    private function setVerificationToken() : self
    {
        $this->validatedInput['token'] = rand(100000, 999999);
        $this->validatedInput['email_verified_at'] = Carbon::now();
        return $this;
    }

    private function uploadPhoto()
    {
        if (request()->hasFile('picture')) {
            $response = FileUploadHelper::UploadFile(request()->file('picture'), 'cv-management/profiles');
            if ($response['success']) {
                $this->validatedInput['picture'] = $response['upload_url'];
            }
        }
        return $this;
    }

    private function sendNotification()
    {
        try {
            Notification::route('mail', $this->user->email)
                ->notify(new WelcomeNotification([
                    "token" => $this->validatedInput['token'],
                    "user" => $this->user
                ]));
        } catch (\Exception $exception) {
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $data = $this->validate($this->request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'user_type' => ['string', 'in:admin,user'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'same:password'],
            'school_id' => ["sometimes", "required", "exists:schools,id"],
            'department_id' => ["sometimes", "required", "exists:departments,id"],
            'qualification_id' => ["sometimes", "required", "exists:qualifications,id"],
            'country_of_origin_id' => ["sometimes", "required", "exists:countries,id"],
            'country_of_residence_id' => ["sometimes", "required", "exists:countries,id"],
            'lg_of_residence_id' => ["sometimes", "required", "exists:lgs,id"],
            'lg_of_origin_id' => ["sometimes", "required", "exists:lgs,id"],
            'picture' => ["sometimes", "required", "file", "max:5000", "mimes:jpg,jpeg,gif,webp"],
            "token" => ["nullable"],
            "is_verified" => ["sometimes", "required", "integer", "in:0,1"],
            "email_verified_at" => ["sometimes", "required", "date"],
            'phone' => ["sometimes", "required", "string", "max:16", "min:8"],
            'gender' => ["sometimes", "required", "in:male,female,other"],
            'marital_status' => ["sometimes", "required", "in:single,divorced,widowed,married"],
            'residential_address' => ["sometimes", "required", "string", "max:255"],
            'permanent_address' => ["sometimes", "required", "string", "max:255"],
            'dob' => ["sometimes", "required", "date"],
            'no_of_children' => ["sometimes", "required", "integer"],
            'status' => ["sometimes", "required", "in:active,inactive,suspended"]
        ]);

        $this->validatedInput = Arr::except($data, ['picture']);
        return $this;
    }
}
