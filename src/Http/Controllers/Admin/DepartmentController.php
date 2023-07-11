<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\Department\CreateDepartment;
use Transave\ScolaCvManagement\Actions\Admin\Department\DeleteDepartment;
use Transave\ScolaCvManagement\Actions\Admin\Department\RegisteredDepartments;
use Transave\ScolaCvManagement\Actions\Admin\Department\UpdateDepartment;


class DepartmentController extends Controller
{

    // Create Department
    /**
     * Register a new department
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerDept(Request $request)
    {
        return (new CreateDepartment($request->all()))->execute();
    }



    // Delete Department
    public function deleteDept(Request $request, DeleteDepartment $deleteDepartment)
    {
        $delete = $deleteDepartment->handle($request);
        return $delete;
    }



    // view all Departement Registered
    public function viewDept(Request $request, RegisteredDepartments $registeredDepartments)
    {
        $update = $registeredDepartments->handle($request);
        return $update;
    }


    // Update Departement Registered
    public function updateDept(Request $request, UpdateDepartment $updateDepartment)
    {
        $update = $updateDepartment->handle($request);
        return $update;
    }

}
