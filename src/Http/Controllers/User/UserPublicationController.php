<?php
namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\User\Publication\CreatePublication;
use Transave\ScolaCvManagement\Actions\User\Publication\RegisteredPublications;
use Transave\ScolaCvManagement\Actions\User\Publication\ViewPublicationDetails;
use Transave\ScolaCvManagement\Actions\User\Publication\UpdatePublication;
use Transave\ScolaCvManagement\Actions\User\Publication\DeletePublication;


class UserPublicationController extends Controller
{

    // Create Achievement
    public function createPub(Request $request, CreatePublication $createPublication)
    {
        $create = $createPublication->handle($request);
        return $create;
    }


    // Update Publications
    public function updatePub(Request $request, UpdatePublication $updatePublication)
    {
        $update = $updatePublication->handle($request);
        return $update;
    }


    // View All Publications
    public function viewAllPub(Request $request, RegisteredPublications $registeredPublications)
    {
        $viewall = $registeredPublications->handle($request);
        return $viewall;
    }


    // View Details
    public function viewPubDetails(Request $request, ViewPublicationDetails $viewPublicationDetails)
    {
        $viewall = $viewPublicationDetails->handle($request);
        return $viewall;
    }


    // Delete Publications
    public function deletePub(Request $request, DeletePublication $deletePublication)
    {
        $delete = $deletePublication->handle($request);
        return $delete;
    }
}
