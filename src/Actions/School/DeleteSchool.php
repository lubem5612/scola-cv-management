<?php

namespace Transave\ScolaCvManagement\Actions\School;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\School;


class DeleteSchool
{
    use ResponseHelper, ValidationHelper;
    private array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getSchool()
                ->destroySchool();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function destroySchool()
    {
        $this->school->delete();
        return $this->sendSuccess(null, 'school deleted successfully');
    }


    public function getSchool()
    {
        $this->school = School::query()->find($this->validator['id']);

        if ($this->school === null) {
            return response()->json(["Status" => 200, "message" => "school not found"
            ]);
        }

        if ($this->school->delete() === false) {
            return response()->json(["Status"=>400, "status"=> false, "message" => "Couldn't delete the school, try again!",
            ]);
        }

        return $this;

    }


    private function validateRequest() : self
    {
        $this->validator =  $this->validate($this->request, [
            'id' => 'required|exists:schools,id'
        ]);
        return $this;
    }
}

