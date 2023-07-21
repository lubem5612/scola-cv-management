<?php

namespace Transave\ScolaCvManagement\Actions\School;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\School;

class RegisteredSchools
{
    use ResponseHelper, ValidationHelper;

    public function execute()
    {
        try {
            return $this->getSchools();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function getSchools(){
        $this->school = School::all();
        return $this->sendSuccess($this->school, 'List of Schools Registered');
    }
}
