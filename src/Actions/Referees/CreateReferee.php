<?php

namespace Transave\ScolaCvManagement\Actions\Referees;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Referee;

class CreateReferee
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
                ->registerReferee();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function registerReferee()
    {
        $this->createReferee = Referee::query()->create($this->data);
        return $this->sendSuccess($this->createReferee, 'Referee created successfully');
    }

    private function validateRequest()
    {
        $this->data = $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'place_of_work' => 'required|string|max:255',
            'contact' => 'required|string',
            'relationship' => 'required|string'

        ]);
        return $this;
    }
}