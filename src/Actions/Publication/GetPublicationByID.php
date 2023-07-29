<?php

namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class GetPublicationByID
{
    use ValidationHelper, ResponseHelper;

    private $request;


    public function __construct($request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getPublication()
                ->sendSuccess($this->publication, 'publication Fetched');

        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getPublication(): self
    {
        $this->publication = Publication::query()->with('cv')->find($this->validatedInput['id']);
        return $this;

    }

    private function validateRequest(): self
    {
       $this->validatedInput = $this->validate($this->request, [
            'id' => 'required|exists:publications,id'
        ]);
        return $this;
    }
}

