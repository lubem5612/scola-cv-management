<?php

namespace Transave\ScolaCvManagement\Actions\School;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\School;

class UpdateSchool
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
                ->getSchool()
                ->updateSchool();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getSchool()
    {
        $this->school = School::query()->find($this->validatedInput['id']);
        return $this;
    }

    private function updateSchool()
    {
        $this->school->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->school->refresh(), 'school updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'id' => 'sometimes|required|string|exists:schools,id',
            'name' => 'sometimes|required|string|max:255',
        ]);
        return $this;
    }
}