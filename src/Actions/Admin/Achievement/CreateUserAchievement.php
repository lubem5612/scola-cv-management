<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Achievement;

use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Achievement;

class CreateUserAchievement
{
    use ValidationHelper, ResponseHelper;
    private $request, $achievement;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createAchievement()
                ->buildResponse('created successfully', true, $this->achievement);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createAchievement()
    {
        $inputs = Arr::only($this->request, ['cv_id', 'title', 'date_achieved', 'user_id', 'description']);
        $this->achievement = Achievement::query()->create($inputs);
        if (empty($this->achievement)) {
            return $this->buildResponse('failed in creating Achievement', false, null);
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $this->validate($this->request, [
            'cv_id' => ['required', 'string', 'max:255', 'exists:cvs,id'],
            'title' => ['required', 'string', 'max:255'],
            'date_achieved' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'exist:users,id'],
            'description' => ['required', 'string', 'max:255'],

        ]);

        return $this;
    }
}


