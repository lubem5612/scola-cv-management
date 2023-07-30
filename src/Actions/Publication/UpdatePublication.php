<?php

namespace Transave\ScolaCvManagement\Actions\Publication;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class UpdatePublication
{
    use ResponseHelper, ValidationHelper;
    private $request;
    private $validatedInput;
    private Publication $publication;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getPublication()
                ->updatePublication();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getPublication()
    {
        $this->publication = Publication::query()->find($this->validatedInput['publication_id']);
        return $this;
    }

    private function updatePublication()
    {
        $this->publication->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->publication->refresh()
            ->load('cv'), 'Publication updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'publication_id' => 'required|exists:publications,id',
            'short_description' => 'sometimes|required|string|max:255',
            'cv_id' => 'sometimes|required|exists:cvs,id',
            'description' => 'sometimes|required|string',
            'link' => 'sometimes|required|string|max:255',
        ]);
        return $this;
    }
}