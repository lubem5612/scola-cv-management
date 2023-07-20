<?php

namespace Transave\ScolaCvManagement\Actions\Specialization;


use Illuminate\Support\Facades\Validator;
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

        if ($this->validator->fails()) {
        return response()->json(['status' => 400, 'data' => [], 'message' => $this->validator->errors()
        ]);
    }
        $input = $this->validator;
        $this->specialization = Specialization::query()->create($input);
        return $this->sendSuccess($this->specialization, 'Specialization created successfully');

    }

    private function validateRequest()
    {
        $this->validator = Validator::make($this->request, [
            'cv_id' => ['required', 'string', 'exists:cvs,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255']
        ]);

        return $this;
    }

}
