<?php


namespace Transave\ScolaCvManagement\Actions\User;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;

class DeleteUser
{
    use ResponseHelper, ValidationHelper;
    private $user;
    private $request, $validatedInput, $uploader;

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
                ->deleteFileIfExist()
                ->deleteUser();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deleteFileIfExist()
    {
        $this->user = config('scolacv.auth_model')::query()->find($this->validatedInput['user_id']);
        if ($this->user->picture) {
            $this->uploader->deleteFile($this->user->picture);
        }
        return $this;
    }

    private function deleteUser()
    {
        $this->user->delete();
        return $this->sendSuccess(null, 'user deleted successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'user_id' => 'required|exists:users,id'
        ]);
        return $this;
    }
}