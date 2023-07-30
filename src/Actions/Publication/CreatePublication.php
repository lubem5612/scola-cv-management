<?php

namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class CreatePublication
{
    use ResponseHelper, ValidationHelper;
    private $request, $data;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->createPublication();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function createPublication()
    {
        $publication = Publication::query()->create($this->data);
        return $this->sendSuccess($publication, 'publication created successfully');
    }

    private function validateRequest()
    {
        $this->data = $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id',
            'link' => 'sometimes|required|string|max:255',
            'short_description' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);
        return $this;
    }
}