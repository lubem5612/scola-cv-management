<?php

namespace Transave\ScolaCvManagement\Actions\Specialization;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Specialization;

class UpdateSpecialization
{
    use ResponseHelper, ValidationHelper;
    private array $request;
    private $validatedInput;

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
                ->updateSpecialization();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getSpecialization()
    {
        $this->specialization = Specialization::query()->find($this->validatedInput['specialization_id']);
        return $this;
    }

    private function updateSpecialization()
    {
        $this->specialization->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->specialization->refresh(), 'specialization updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'specialization_id' => 'required|string|exists:specializations,id',
            'cv_id' => 'sometimes|required|string|exists:cvs,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
        ]);
        return $this;
    }
}