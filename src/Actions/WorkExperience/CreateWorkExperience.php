<?php

namespace Transave\ScolaCvManagement\Actions\WorkExperience;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;

class CreateWorkExperience
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
                ->createWorkExperience();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function createWorkExperience()
    {
        $workExperience = WorkExperience::query()->create($this->data);
        return $this->sendSuccess($workExperience, 'Work Experience created successfully');
    }

    private function validateRequest()
    {
        $this->data = $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id',
            'position' => 'required|string|max:255',
            'responsibilities' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255'

        ]);
        return $this;
    }
}