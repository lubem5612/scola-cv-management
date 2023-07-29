<?php

namespace Transave\ScolaCvManagement\Actions\WorkExperience;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;

class DeleteWorkExperience
{
    use ResponseHelper, ValidationHelper;
    private $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getExperience()
                ->deleteExperience();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deleteExperience()
    {
        $this->workexperience->delete();
        return $this->sendSuccess(null, 'work experience deleted successfully');
    }

    private function getExperience() :self
    {
        $this->workexperience = WorkExperience::query()->find($this->input['id']);
        return  $this;
    }

    private function validateRequest() : self
    {
        $this->input = $this->validate($this->request, [
            'id' => 'required|exists:work_experiences,id'
        ]);
        return $this;
    }

}