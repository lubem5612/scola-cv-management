<?php


namespace Transave\ScolaCvManagement\Actions\Credential;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Credential;

class UpdateCredential
{
    use ResponseHelper, ValidationHelper;
    private array $request;
    private array $validatedInput;
    private $uploader;
    private Credential $credential;

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
                ->getCredential()
                ->setUploadFileUrl()
                ->generateSlug()
                ->updateCredential();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getCredential()
    {
        $this->credential = Credential::query()->find($this->validatedInput['credential_id']);
        return $this;
    }

    private function setUploadFileUrl()
    {
        if (array_key_exists('file', $this->request)) {
            $response = $this->uploader->uploadOrReplaceFile($this->request['file'], 'credentials', $this->credential, 'file');
            if ($response['success']) {
                $this->validatedInput['file'] = $response['upload_url'];
                $this->validatedInput['size'] = $response['size'];
                $this->validatedInput['extension'] = $response['mime_type'];
            }
        }
        return $this;
    }

    private function generateSlug()
    {
        if (array_key_exists('slug', $this->validatedInput)) {
            $this->validatedInput['slug'] = Str::slug($this->validatedInput['slug'], '-');
        }
        return $this;
    }

    private function updateCredential()
    {
        $this->credential->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->credential->refresh(), 'credential updated successfully');
    }

    private function validateRequest()
    {
        $data = $this->validate($this->request, [
            'credential_id' => 'required|exists:credentials,id',
            'cv_id' => 'sometimes|required|exists:cvs,id',
            'slug' => 'sometimes|required|string|max:255',
            'file' => 'sometimes|required|file|max:5000|mimes:jped,jpg,gif,webp,pdf,doc,docx',
        ]);
        $this->validatedInput = Arr::only($data, ['cv_id', 'slug', 'credential_id']);
        return $this;
    }
}