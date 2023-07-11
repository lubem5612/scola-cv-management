<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Faculty;

use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Faculty;

class CreateFaculty
{
    use ValidationHelper, ResponseHelper;
    private $request, $faculty;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createFaculty()
                ->buildResponse('created successfully', true, $this->faculty);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createFaculty()
    {
        $inputs = Arr::only($this->request, ['name']);
        $this->faculty = Faculty::query()->create($inputs);
        if (empty($this->faculty)) {
            return $this->buildResponse('failed in creating Faculty', false, null);
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


