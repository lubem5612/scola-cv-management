<?php
namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\User\Specialization\DeleteSpecialization;
use Transave\ScolaCvManagement\Actions\User\Specialization\AddSpecialization;
use Transave\ScolaCvManagement\Actions\User\Specialization\EditSpecialization;
use Transave\ScolaCvManagement\Actions\User\Specialization\ViewAllSpecialization;



class UserSpecializationController extends Controller
{

    // Create Achievement
    public function registerSpec(Request $request, AddSpecialization $addSpecialization)
    {
        $create = $addSpecialization->handle($request);
        return $create;
    }


    // Update Achievement
    public function deleteSpec(Request $request, DeleteSpecialization $deleteSpecialization)
    {
        $delete = $deleteSpecialization->handle($request);
        return $delete;
    }


    // View All Achievement
    public function viewAllSpec(Request $request, ViewAllSpecialization $viewAllSpecialization)
    {
        $all = $viewAllSpecialization->handle($request);
        return $all;
    }


    // Delete Achievement
    public function editSpec(Request $request, EditSpecialization $editSpecialization)
    {
        $edit = $editSpecialization->handle($request);
        return $edit;
    }
}
