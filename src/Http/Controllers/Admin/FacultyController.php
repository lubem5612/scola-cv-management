<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\Faculty\CreateFaculty;
use Transave\ScolaCvManagement\Actions\Admin\Faculty\DeleteFaculty;
use Transave\ScolaCvManagement\Actions\Admin\Faculty\RegisteredFaculty;
use Transave\ScolaCvManagement\Actions\Admin\Faculty\UpdateFaculty;


class FacultyController extends Controller
{

    // Create Faculty
    /**
     * Register a new faculty
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function regFaculty(Request $request)
    {
        return (new CreateFaculty($request->all()))->execute();
    }



    // Delete Faculty
    public function delFaculty(Request $request, DeleteFaculty $deleteFaculty)
    {
        $delete = $deleteFaculty->handle($request);
        return $delete;
    }



    // view all Faculty Registered
    public function viewFaculties(Request $request, RegisteredFaculty $registeredFaculty)
    {
        $update = $registeredFaculty->handle($request);
        return $update;
    }


    // Update Faculty Registered
    public function editFaculty(Request $request, UpdateFaculty $updateFaculty)
    {
        $update = $updateFaculty->handle($request);
        return $update;
    }

}
