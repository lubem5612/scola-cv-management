<?php

namespace Transave\ScolaCvManagement\Actions\Publication;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class UpdatePublication
{
    use ResponseHelper, ValidationHelper;
    private array $request;
    private array $validatedInput;

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
        $this->publication = Publication::query()->where('id', $this->validatedInput['publication_id']);
        return $this;
    }

    private function updatePublication()
    {
        $this->publication->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->publication->refresh(), 'publication updated successfully');
    }


    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'short_description' => 'required|string',
            'cv_id ' => 'sometimes|required|exists:cvs,id',
            'description' => 'sometimes|required|string|max:255',
            'link' => 'sometimes|required|string',
        ]);
        return $this;
    }
}