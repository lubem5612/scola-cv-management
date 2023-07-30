<?php


namespace Transave\ScolaCvManagement\Actions\Gallery;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Gallery;

class DeleteGallery
{
    use ResponseHelper, ValidationHelper;
    private Gallery $gallery;
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
                ->deleteGallery();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deleteFileIfExist()
    {
        $this->gallery = Gallery::query()->find($this->validatedInput['gallery_id']);
        if ($this->gallery->photo) {
            $this->uploader->deleteFile($this->gallery->photo);
        }
        return $this;
    }

    private function deleteGallery()
    {
        $this->gallery->delete();
        return $this->sendSuccess(null, 'gallery deleted successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'gallery_id' => 'required|exists:galleries,id'
        ]);
        return $this;
    }
}