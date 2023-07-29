<?php

namespace Transave\ScolaCvManagement\Actions\Referees;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Referee;

class DeleteReferee
{
    use ResponseHelper, ValidationHelper;
    private $request, $validatedInput;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getReferee()
                ->destroyReferee();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getReferee()
    {
        $this->referee = Referee::query()->find($this->validatedInput['referee_id']);
        return $this;
    }

    private function destroyReferee()
    {
        $this->referee->delete();
        return $this->sendSuccess(null, 'referee deleted successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'referee_id' => 'required|exists:referees,id'
        ]);
        return $this;
    }
}