<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Qualifications;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Qualifications;


class RegisterQualification
{
    use ValidationHelper, ResponseHelper;
    private $request, $qualifications;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createQualification()
                ->buildResponse('created successfully', true, $this->qualifications);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createQualification()
    {
        $inputs = Arr::only($this->request, ['qualification']);
        $this->qualifications = Qualifications::query()->create($inputs);
        if (empty($this->qualifications)) {
            return $this->buildResponse('failed in creating Qualification', false, null);
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $this->validate($this->request, [
            'qualification' => ['required', 'string', 'max:255'],
        ]);

        return $this;
    }
}
