<?php

namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class DeletePublication
{
    use ResponseHelper, ValidationHelper;
    private $request, $validatedInput;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->deletePublication();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deletePublication()
    {
        Publication::destroy($this->validatedInput['publication_id']);
        return $this->sendSuccess(null, 'publication deleted successfully');
    }

    private function validateRequest() : self
    {
        $this->validatedInput = $this->validate($this->request, [
            'publication_id' => 'required|exists:publications,id'
        ]);
        return $this;
    }

}