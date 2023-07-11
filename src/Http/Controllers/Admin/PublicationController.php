<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin\PublicationControllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\Publication\CreatePublication;
use Transave\ScolaCvManagement\Actions\Admin\Publication\DeletePublication;
use Transave\ScolaCvManagement\Actions\Admin\Publication\UpdateUserPublication;
use Transave\ScolaCvManagement\Actions\Admin\Publication\ViewAllPublications;
use Transave\ScolaCvManagement\Actions\Admin\Publication\ViewSinglePublicationDetails;


class PublicationController extends Controller
{

    // Create user Publication
    /**
     * Register a new publication
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerUserPub(Request $request)
    {
        return (new CreatePublication($request->all()))->execute();
    }


    // Delete User Publication
    public function deleteUserPub(Request $request, DeletePublication $deletePublication)
    {
        $delete = $deletePublication->handle($request);
        return $delete;
    }


    // Update User Publication
    public function updateUserPub(Request $request, UpdateUserPublication $updateUserPublication)
    {
        $update = $updateUserPublication->handle($request);
        return $update;
    }

    // View all Publication for a User
    public function viewUserPub(Request $request, ViewAllPublications $viewAllPublications)
    {
        $show = $viewAllPublications->handle($request);
        return $show;
    }

    // View single Publication
    public function viewSinglePub(Request $request, ViewSinglePublicationDetails $viewSinglePublicationDetails)
    {
        $details = $viewSinglePublicationDetails->handle($request);
        return $details;
    }

}


