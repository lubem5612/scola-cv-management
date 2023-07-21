<?php

namespace Transave\ScolaCvManagement\Actions\Referees;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Referee;

class AllUsersRefereesList
{
    use ValidationHelper, ResponseHelper;
    private array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }


    public function execute()
    {
        try {
            return $this
                ->getReferees()
                ->sendSuccess($this->referee, 'referee(s) fetched successfully');

        } catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }


    private function getReferees(): self
    {
        $this->referee = Referee::all();
        return $this;

    }
}

