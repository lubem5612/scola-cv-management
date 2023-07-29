<?php

namespace Transave\ScolaCvManagement\Actions\School;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\School;


class CreateSchool
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
            return $this->validateRequest()->registerSchool();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }


    private function registerSchool()
    {
        $this->school = School::query()->create($this->validatedInput);
        return $this->sendSuccess($this->school, 'School created successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'name' => ['required', 'string', 'max:255']
        ]);

        return $this;
    }

}
