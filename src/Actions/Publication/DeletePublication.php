<?php
namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class DeletePublication
{
    use ResponseHelper, ValidationHelper;
    private Publication $publication;
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
        $publication = Publication::query()->find($this->validatedInput['publication_id']);

        if ($publication  === null) {
            return $this->sendError(null, 'publication not found', '404');
        }

        if ($publication->delete() === false) {
            return $this->sendError(null, 'Error Occur, try Again', '400');
        }

        $publication->delete();
        return $this->sendSuccess(null, 'publication deleted successfully');
    }


    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'publication_id' => 'required|exists:publications,id'
        ]);
        return $this;
    }
}