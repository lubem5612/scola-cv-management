<?php
namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class AllUsersPublications
{
    use ResponseHelper, ValidationHelper;

    public function execute()
    {
        try {
            $publication = Publication::all();
            return $this->sendSuccess($publication, 'List of All Publications');
        }
        catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

}
