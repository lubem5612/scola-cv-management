<?php

namespace Transave\ScolaCvManagement\Actions\Specialization;

use Illuminate\Support\Facades\Validator;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Specialization;


class SingleUserSpecializations
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
                ->sendSuccess($this->specialization, 'specialization(s) fetched successfully');
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

        private function getSpecialization(){

         $this->specialization = Specialization::query()->where('cv_id', $this->validatedInput['cv_id'])->first();

         if ($this->specialization === null) {
                return response()->json(["Status"=>200, "data"=>[], "message" => "specialization not found",
                ]);

            }

         return $this;
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'cv_id'=> 'required|string|exists:cvs,id'
        ]);

        return $this;
    }

}
