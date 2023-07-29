<?php


namespace Transave\ScolaCvManagement\Actions\Auth;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;

class UpdateAccount
{
    use ValidationHelper, ResponseHelper;
    private $request, $uploader, $user;
    private $validatedInput;
    public function __construct(array $request)
    {
        $this->request = $request;
        $this->uploader = new UploadHelper();
    }

    public function execute()
    {
        try {
            return $this->validateRequest()->setUser()->checkIfNewEmail()->uploadPictureIfExists()->updateUser();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function setUser()
    {
        $this->user = config('scolacv.auth_model')::query()->find($this->validatedInput['user_id']);
        return $this;
    }

    private function checkIfNewEmail()
    {
        if ($this->user->isDirty('email')) {
            $this->validatedInput['email'] = $this->request['email'];
        }
        return $this;
    }

    private function uploadPictureIfExists()
    {
        if($this->request['picture']) {
            $response = $this->uploader->uploadOrReplaceFile($this->request['picture'], 'cv-management/profile', $this->user, 'picture');
            if ($response['success']) {
                $this->validatedInput['picture'] = $response['upload_url'];
            }
        }
        return $this;
    }

    private function updateUser()
    {
        $this->user->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->user->refresh(), 'user updated');
    }

    private function validateRequest()
    {
        $data = $this->validate($this->request, [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'user_type' => 'sometimes|required|in:admin,user',
            'qualification_id' => 'sometimes|required|exists:qualifications,id',
            'country_of_origin_id' => 'sometimes|required|exists:countries,id',
            'country_of_residence_id' => 'sometimes|required|exists:countries,id',
            'lg_of_residence_id' => 'sometimes|required|exists:lgs,id',
            'lg_of_origin_id' => 'sometimes|required|exists:lgs,id',
            'school_id' => 'sometimes|required|exists:schools,id',
            'email' => 'sometimes|required|unique:users,email',
            'email_verified_at' => 'sometimes|required|date',
            'is_verified' => 'sometimes|required|in:1,0',
            'department_id' => 'sometimes|required|exists:departments,id',
            'residential_address'=> 'sometimes|required|string|max:255',
            'permanent_address'=> 'sometimes|required|string|max:255',
            'marital_status'=> 'sometimes|required|string|max:15',
            'dob'=> 'sometimes|required|date',
            'no_of_children'=>'sometimes|required|integer',
            'gender'=> 'sometimes|required|string|max:45',
            'phone'=> 'sometimes|required|string|max:18|min:8',
            'picture' => 'sometimes|required|file|max:5000|mimes:png,jpeg,jpg,gif,webp',
            'status' => 'sometimes|required_if:user_type,admin'
        ]);
        $this->validatedInput = Arr::except($data, ['email', 'picture']);
        return $this;
    }
}