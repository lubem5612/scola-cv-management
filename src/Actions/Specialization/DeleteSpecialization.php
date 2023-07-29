<?php

namespace Transave\ScolaCvManagement\Actions\Specialization;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Specialization;


class DeleteSpecialization
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
                ->getSpecialization()
                ->destroySpecialization();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function destroySpecialization()
    {
        $this->specialization->delete();
        return $this->sendSuccess(null, 'specialization deleted successfully');
    }


    public function getSpecialization()
    {
        $this->specialization = Specialization::query()->find($this->validator['id']);

        if ($this->specialization === null) {
            return response()->json(["Status" => 200, "message" => "User not found"
            ]);
        }

        if ($this->specialization->delete() === false) {
            return response()->json(["Status"=>400, "status"=> false, "message" => "Couldn't delete the specialization",
            ]);
        }

        return $this;

    }


    private function validateRequest() : self
    {
      $this->validator =  $this->validate($this->request, [
            'id' => 'required|exists:specializations,id'
        ]);
        return $this;
    }
}

