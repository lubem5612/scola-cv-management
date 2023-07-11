<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\School\CreateSchool;
use Transave\ScolaCvManagement\Actions\Admin\School\DeleteSchool;
use Transave\ScolaCvManagement\Actions\Admin\School\RegisteredSchools;
use Transave\ScolaCvManagement\Actions\Admin\School\UpdateSchool;


class SchoolController extends Controller
{

    // Create School
    /**
     * Register a new School
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerSch(Request $request)
    {
        return (new CreateSchool($request->all()))->execute();
    }



    // Delete School
    public function deleteSch(Request $request, DeleteSchool $deleteSchool)
    {
        $delete = $deleteSchool->handle($request);
        return $delete;
    }



    // view all Schools Registered
    public function viewSch(Request $request, RegisteredSchools $registeredSchools)
    {
        $update = $registeredSchools->handle($request);
        return $update;
    }


    // Update School Registered
    public function updateDept(Request $request, UpdateSchool $updateSchool)
    {
        $update = $updateSchool->handle($request);
        return $update;
    }

}
