<?php

namespace Transave\ScolaCvManagement\Actions\Referees;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\UploadHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Referee;

class UpdateReferee
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
                ->getReferee()
                ->updateCredential();
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getReferee()
    {
        $this->referee = Referee::query()->find($this->validatedInput['referee_id']);
        return $this;
    }

    private function updateCredential()
    {
        $this->referee->fill($this->validatedInput)->save();
        return $this->sendSuccess($this->referee->refresh(), 'referee updated successfully');
    }

    private function validateRequest()
    {
        $this->validatedInput = $this->validate($this->request, [
            'referee_id' => 'required|exists:referees,id',
            'cv_id' => 'sometimes|required|exists:cvs,id',
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'place_of_work' => 'sometimes|required|string|max:255',
            'contact' => 'sometimes|required|string',
            'relationship' => 'sometimes|required|string'
        ]);
        return $this;
    }
}