<?php

namespace Transave\ScolaCvManagement\Actions\Achievement;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Achievement;

class CreateAchievement
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
                ->createAchievement();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function createAchievement()
    {
        $achievement = Achievement::query()->create($this->data);
        return $this->sendSuccess($achievement, 'Achievement created successfully');
    }

    private function validateRequest()
    {
        $this->data = $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id',
            'title' => 'required|string|max:255',
            'date_achieved' => 'required|string',
            'description' => 'required|string|max:255',
        ]);
        return $this;
    }
}