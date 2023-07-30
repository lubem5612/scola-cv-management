<?php


namespace Transave\ScolaCvManagement\Actions\Gallery;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Gallery;

class CreateGallery
{
    use ResponseHelper, ValidationHelper;
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
                ->setSlug()
                ->uploadImage()
                ->createGallery();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function setSlug()
    {
        if (!array_key_exists('slug', $this->validatedInput)) {
            $this->validatedInput['slug'] = request()->file('photo')->getClientOriginalName();
        }
        return $this;
    }

    private function uploadImage()
    {
        $response = $this->uploader->uploadFile($this->request['photo'], 'galleries');
        if ($response['success']) {
            $this->validatedInput['photo'] = $response['upload_url'];
            $this->validatedInput['size'] = $response['size'];
            $this->validatedInput['extension'] = $response['mime_type'];
        }
        return $this;
    }

    private function createGallery()
    {
        $gallery = Gallery::query()->create($this->validatedInput);
        return $this->sendSuccess($gallery->load('cv'), 'gallery created successfully');
    }

    private function validateRequest()
    {
        $data = $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id',
            'slug' => 'sometimes|required|string|max:255',
            'photo' => 'required|file|max:5000|mimes:jpg,jpeg,gif,png,bmp,webp',
        ]);

        $this->validatedInput = Arr::only($data, ['slug', 'cv_id']);
        return $this;
    }
}