<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Publication;


use Illuminate\Support\Arr;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;


class CreatePublication
{
    use ValidationHelper, ResponseHelper;
    private $request, $publications;

    public function __construct(array  $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try{
            return $this
                ->validateRequest()
                ->createUserPublication()
                ->buildResponse('created successfully', true, $this->publications);
        }catch (\Exception $exception){
            return $this->sendServerError($exception);
        }
    }


    private function createUserPublication()
    {
        $inputs = Arr::only($this->request, ['user_id', 'publication']);
        $this->publications = Publication::query()->create($inputs);
        if (empty($this->publications)) {
            return $this->buildResponse('failed in creating Publication', false, null);
        }
        return $this;
    }

    public function validateRequest(): self
    {
        $this->validate($this->request, [
            'user_id' => ['max:255', 'exists:users,id'],
            'publication' => ['string', 'max:255']
        ]);

        return $this;
    }
}




