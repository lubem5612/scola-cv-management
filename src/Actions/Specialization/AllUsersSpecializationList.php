<?php

namespace Transave\ScolaCvManagement\Actions\Specialization;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Specialization;


class AllUsersSpecializationList
    {

    use ResponseHelper, ValidationHelper;

    public function execute()
    {
        try {
            return $this->getSpecializations();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    public function getSpecializations(){
                $this->specializations = Specialization::all();
                return $this->sendSuccess($this->specializations, 'List of Specializations');
            }
    }
