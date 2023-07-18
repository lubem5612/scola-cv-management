<?php
namespace Transave\ScolaCvManagement\Actions\Publication;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\ValidationHelper;
use Transave\ScolaCvManagement\Http\Models\Publication;

class SingleUserPublications
{
    use ValidationHelper, ResponseHelper;
    private $request;

    /**
     * SingleUserPublication constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        try {
            return $this
                ->validateRequest()
                ->getPublication()
                ->sendSuccess($this->publication, 'Publications fetched successfully');
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function getPublication()
    {
        $this->publication = Publication::query()->where('cv_id', $this->data['cv_id']);
        return $this;
    }

    private function validateRequest() : self
    {
       $this->data =  $this->validate($this->request, [
            'cv_id' => 'required|exists:cvs,id'
        ]);
        return $this;
    }
}