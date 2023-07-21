<?php

namespace Transave\ScolaCvManagement\Actions\Specialization;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Specialization;


class CreateSpecialization
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
            return $this->validateRequest()->registerSpecialization();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }


    private function registerSpecialization()
    {
        $this->specialization = Specialization::query()->create($this->validatedInput);
        return $this->sendSuccess($this->specialization, 'Specialization created successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'cv_id' => ['required', 'string', 'exists:cvs,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255']
        ]);

        return $this;
    }

}
