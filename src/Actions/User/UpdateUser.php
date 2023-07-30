<?php


namespace Transave\ScolaCvManagement\Actions\User;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;

class UpdateUser
{
    use ResponseHelper, ValidationHelper;
    private $request;
    private $validatedInput;
    private $uploader;
    private $user;

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->uploader = new UploadHelper();
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->setUser()
                ->uploadOrReplaceProfilePicture()
                ->updateUser();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function setUser()
    {
        $this->user = config('scolacv.auth_model')::query()->find($this->validatedInput['user_id']);
        return $this;
    }

    private function uploadOrReplaceProfilePicture()
    {
        if (array_key_exists('picture', $this->request)) {
            $response = $this->uploader->uploadOrReplaceFile($this->request['picture'], 'profiles', $this->user, 'picture');
            if ($response['success']) {
                $this->validatedInput['picture'] = $response['upload_url'];
            }
        }
        return $this;
    }

    private function updateUser()
    {
        $this->user->fill($this->validatedInput)->save();
        return $this
            ->sendSuccess($this->user->refresh()
                ->load('school', 'department', 'origin', 'residence', 'lgOfOrigin', 'lgOfResidence'), 'user account updated');
    }

    private function validateRequest(): self
    {
        $data = $this->validate($this->request, [
            'user_id' => ['required', 'exists:users,id'],
            'first_name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'unique:users'],
            'user_type' => ['sometimes', 'string', 'in:admin,user'],
            'school_id' => ["sometimes", "required", "exists:schools,id"],
            'department_id' => ["sometimes", "required", "exists:departments,id"],
            'qualification_id' => ["sometimes", "required", "exists:qualifications,id"],
            'country_of_origin_id' => ["sometimes", "required", "exists:countries,id"],
            'country_of_residence_id' => ["sometimes", "required", "exists:countries,id"],
            'lg_of_residence_id' => ["sometimes", "required", "exists:lgs,id"],
            'lg_of_origin_id' => ["sometimes", "required", "exists:lgs,id"],
            'picture' => ["sometimes", "required", "file", "max:5000", "mimes:jpg,jpeg,gif,webp"],
            'phone' => ["sometimes", "required", "string", "max:20", "min:8"],
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