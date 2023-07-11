<?php
namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\User\WorkExperience\CreateWorkExperience;
use Transave\ScolaCvManagement\Actions\User\WorkExperience\DeleteWorkExperience;
use Transave\ScolaCvManagement\Actions\User\WorkExperience\UpdateWorkExperience;
use Transave\ScolaCvManagement\Actions\User\WorkExperience\ViewAllWorkExperience;


class UserWorkExperienceController extends Controller
{
    // Create WorkExperience
    public function createWorkExp(Request $request, CreateWorkExperience $createWorkExperience)
    {
        $reg = $createWorkExperience->handle($request);
        return $reg;
    }


    // Delete WorkExperience
    public function deleteWorkExp(Request $request, DeleteWorkExperience $deleteWorkExperience)
    {
        $del = $deleteWorkExperience->handle($request);
        return $del;
    }


    // update WorkExperience
    public function updateWorkExp(Request $request, UpdateWorkExperience $updateWorkExperience)
    {
        $update = $updateWorkExperience->handle($request);
        return $update;
    }


    // view all WorkExperience
    public function viewWorkExp(Request $request, ViewAllWorkExperience $viewAllWorkExperience)
    {
        $view = $viewAllWorkExperience->handle($request);
        return $view;
    }

}
