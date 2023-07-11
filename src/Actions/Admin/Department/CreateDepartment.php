<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Department;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Department;


class CreateDepartment
{
    use ValidationHelper, ResponseHelper;
    private $request, $department;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createDept()
                ->buildResponse('created successfully', true, $this->user);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createDept()
    {
        $inputs = Arr::only($this->request, ['name']);
        $this->department = Department::query()->create($inputs);
        if (empty($this->department)) {
            return $this->buildResponse('failed in creating Department', false, null);
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
