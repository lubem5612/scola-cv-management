<?php

namespace Transave\ScolaCvManagement\Actions\Achievement;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Achievement;

class GetAchievementByID
{
    use ValidationHelper, ResponseHelper;

    private $request;


    public function __construct($request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getAchievement()
                ->sendSuccess($this->achievement, 'Achievement Fetched');

        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getAchievement(): self
    {
        $this->achievement = Achievement::query()->with('cv')->find($this->validatedInput['id']);
        return $this;

    }

    private function validateRequest(): self
    {
        $this->validatedInput = $this->validate($this->request, [
            'id' => 'required|exists:achievements,id'
        ]);
        return $this;
    }
}