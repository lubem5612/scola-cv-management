<?php
namespace Transave\ScolaCvManagement\Actions\Admin\School;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Schools;


class CreateSchool
{
    use ValidationHelper, ResponseHelper;
    private $request, $schools;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createSchool()
                ->buildResponse('created successfully', true, $this->schools);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createSchool()
    {
        $inputs = Arr::only($this->request, ['name']);
        $this->schools = Schools::query()->create($inputs);
        if (empty($this->schools)) {
            return $this->buildResponse('failed in creating School', false, null);
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $this->validate($this->request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        return $this;
    }
}
