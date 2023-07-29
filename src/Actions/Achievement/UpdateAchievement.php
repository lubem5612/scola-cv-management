<?php

namespace Transave\ScolaCvManagement\Actions\Achievement;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Achievement;

class UpdateAchievement
{
    use ResponseHelper, ValidationHelper;
    private array $request;
    private array $validatedInput;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getAchievement()
                ->updateAchievement();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getAchievement()
    {
        $this->achievement = Achievement::query()->find($this->validatedInput['achievement_id']);

        return $this;
    }

    private function updateAchievement()
    {
        $this->achievement->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->achievement->refresh(), 'Achievement updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'achievement_id' => 'required|exists:achievements,id',
            'title' => 'required|string',
            'cv_id' => 'required|exists:cvs,id',
            'description' => 'required|string|max:255',
            'date_achieved' => 'required|string',
        ]);
        return $this;
    }
}