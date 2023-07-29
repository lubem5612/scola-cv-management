<?php

namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class AllUsersPublicationList
{
    use ValidationHelper, ResponseHelper;

    private array $request;


    public function __construct(array $request)
    {
        $this->request = $request;
    }


    public function execute()
    {
        try {
            return $this
                ->getPublication()
                ->sendSuccess($this->publication, 'publication fetched successfully');

        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }


    private function getPublication(): self
    {
        $this->publication = Publication::all();
        return $this;

    }
}

