<?php
namespace Transave\ScolaCvManagement\Actions\Admin\WorkExperience;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;


class CreateUserWorkExperience
{
    use ValidationHelper, ResponseHelper;
    private $request, $workExperience;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createUserWorkExp()
                ->buildResponse('created successfully', true, $this->workExperience);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createUserWorkExp()
    {
        $inputs = Arr::only($this->request, ['user_id', 'companyName', 'position', 'responsibilities', 'startDate', 'endDate']);
        $this->workExperience = WorkExperience::query()->create($inputs);
        if (empty($this->workExperience)) {
            return $this->buildResponse('failed in creating WorkExperience', false, null);
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $this->validate($this->request, [
            'companyName' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'max:255', 'exists:users,id'],
            'responsibilities' => ['required', 'string', 'max:255'],
            'startDate' => 'required'|'string',
            'endDate' => 'required'|'string',
        ]);

        return $this;
    }
}
