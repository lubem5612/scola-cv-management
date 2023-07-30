<?php

namespace Transave\ScolaCvManagement\Actions\Achievement;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Achievement;

class AllUsersAchievementList
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
                ->getAchievement()
                ->sendSuccess($this->achievement, 'Achievements fetched successfully');

        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }


    private function getAchievement(): self
    {
        $this->achievement = Achievement::all();
        return $this;

    }
}

