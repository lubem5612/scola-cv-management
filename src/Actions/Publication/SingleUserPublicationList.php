<?php

namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class SingleUserPublicationList
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
                ->sendSuccess($this->publication, 'publications fetched successfully');

        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }


    private function getPublication(): self
    {
        $this->publication = Publication::query()->where('cv_id', $this->validatedInput['cv_id'])->first();
        return $this;
    }


    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'cv_id' => 'sometimes|required|exists:cvs,id',
        ]);
        return $this;
    }
}

