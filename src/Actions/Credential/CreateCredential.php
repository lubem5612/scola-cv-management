<?php


namespace Transave\ScolaCvManagement\Actions\Credential;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Credential;

class CreateCredential
{
    use ResponseHelper, ValidationHelper;
    private array $request;
    private array $validatedInput;
    private $uploader;

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
                ->setUploadFileUrl()
                ->generateSlug()
                ->createCredential();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function setUploadFileUrl()
    {
        if (request()->hasFile('file')) {
            $response = $this->uploader->uploadFile(request()->file('file'), 'credentials', 'azure');
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
        $this->validatedInput['slug'] = Str::slug($this->validatedInput['slug'], '-');
        return $this;
    }

    private function createCredential()
    {
        $credential = Credential::query()->create($this->validatedInput);
        return $this->sendSuccess($credential, 'credential created successfully');
    }

    private function validateRequest()
    {
        $data = $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id',
            'slug' => 'required|string|max:255',
            'file' => 'required|file|max:5000|mimes:jped,jpg,gif,webp,pdf,doc,docx',
        ]);
        $this->validatedInput = Arr::only($data, ['cv_id', 'slug']);
        return $this;
    }
}