<?php


namespace Transave\ScolaCvManagement\Actions\Credential;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Credential;

class DeleteCredential
{
    use ResponseHelper, ValidationHelper;
    private Credential $credential;
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
                ->deleteCredential();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deleteFileIfExist()
    {
        $this->credential = Credential::query()->find($this->validatedInput['credential_id']);
        if ($this->credential->file) {
            $this->uploader->deleteFile($this->credential->file, 'azure');
        }
        return $this;
    }

    private function deleteCredential()
    {
        $this->credential->delete();
        return $this->sendSuccess(null, 'credential deleted successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'credential_id' => 'required|exists:credentials,id'
        ]);
        return $this;
    }
}