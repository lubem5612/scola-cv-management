<?php

namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class DeletePublication
{
    use ResponseHelper, ValidationHelper;
    private $request;

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
                ->deletePublication();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deletePublication()
    {
        $this->publication->delete();
        return $this->sendSuccess(null, 'publication deleted successfully');
    }

    private function getPublication() :self
    {
        $this->publication = Publication::query()->find($this->request['id']);
        return  $this;
    }

    private function validateRequest() : self
    {
        $this->validate($this->request, [
            'id' => 'required|exists:publications,id'
        ]);
        return $this;
    }

}