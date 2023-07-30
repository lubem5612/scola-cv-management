<?php


namespace Transave\ScolaCvManagement\Actions\Gallery;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Gallery;

class UpdateGallery
{
    use ResponseHelper, ValidationHelper;
    private $request, $validatedInput, $uploader;
    private Gallery $gallery;

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
                ->setGallery()
                ->setSlug()
                ->uploadOrReplaceImage()
                ->updateGallery();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function setGallery()
    {
        $this->gallery = Gallery::query()->find($this->validatedInput['gallery_id']);
        return $this;
    }

    private function setSlug()
    {
        if (array_key_exists('photo', $this->request) && !array_key_exists('slug', $this->validatedInput)) {
            $this->validatedInput['slug'] = request()->file('photo')->getClientOriginalName();
        }
        return $this;
    }

    private function uploadOrReplaceImage()
    {
        $response = $this->uploader->uploadOrReplaceFile($this->request['photo'], 'galleries', $this->gallery, 'photo');
        if ($response['success']) {
            $this->validatedInput['photo'] = $response['upload_url'];
            $this->validatedInput['size'] = $response['size'];
            $this->validatedInput['extension'] = $response['mime_type'];
        }
        return $this;
    }

    private function updateGallery()
    {
        $this->gallery->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->gallery->refresh()->load('cv'), 'gallery updated successfully');
    }

    private function validateRequest()
    {
        $data = $this->validate($this->request, [
            'gallery_id' => 'required|exists:galleries,id',
            'cv_id' => 'sometimes|required|exists:cvs,id',
            'slug' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|required|file|max:5000|mimes:jpg,jpeg,gif,png,bmp,webp',
        ]);

        $this->validatedInput = Arr::except($data, ['photo']);
        return $this;
    }
}