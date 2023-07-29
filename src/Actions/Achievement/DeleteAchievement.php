<?php

namespace Transave\ScolaCvManagement\Actions\Achievement;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Achievement;

class DeleteAchievement
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
                ->getAchievement()
                ->deleteAchievement();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function deleteAchievement()
    {
        $this->achievement->delete();
        return $this->sendSuccess(null, 'achievement deleted successfully');
    }

    private function getAchievement() :self
    {
        $this->achievement = Achievement::query()->find($this->input['id']);
        return  $this;
    }

    private function validateRequest() : self
    {
       $this->input = $this->validate($this->request, [
            'id' => 'required|exists:achievements,id'
        ]);
        return $this;
    }

}