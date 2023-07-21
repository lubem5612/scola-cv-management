<?php
namespace Transave\ScolaCvManagement\Actions\WorkExperience;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;

class UpdateWorkExperience
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
                ->getWorkExperience()
                ->updateWorkExperience();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getWorkExperience()
    {
        $this->workexperience = WorkExperience::query()->find($this->validatedInput['workexperience_id']);

        return $this;
    }

    private function updateWorkExperience()
    {
        $this->workexperience->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->workexperience->refresh(), 'Work experience updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'workexperience_id' => 'required|exists:work_experiences,id',
            'cv_id' => 'sometimes|required|exists:cvs,id',
            'position' => 'required|string|max:255',
            'responsibilities' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255'
        ]);
        return $this;
    }
}