<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\WorkExperience\CreateUserWorkExperience;
use Transave\ScolaCvManagement\Actions\Admin\WorkExperience\DeleteUserWorkExperience;
use Transave\ScolaCvManagement\Actions\Admin\WorkExperience\UpdateUserWorkExperience;
use Transave\ScolaCvManagement\Actions\Admin\WorkExperience\ViewUserWorkExperienceDetails;


class WorkExperienceController extends Controller
{

    // Create work experience
    /**
     * Register a new work experience
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerWorkExp(Request $request)
    {
        return (new CreateUserWorkExperience($request->all()))->execute();
    }



    // Delete User work experience
    public function deleteWorkExp(Request $request, DeleteUserWorkExperience $deleteUserWorkExperience)
    {
        $delete = $deleteUserWorkExperience->handle($request);
        return $delete;
    }



    // view  User work experience
    public function viewWorkExp(Request $request, ViewUserWorkExperienceDetails $viewUserWorkExperienceDetails)
    {
        $view = $viewUserWorkExperienceDetails->handle($request);
        return $view;
    }


    // Update User work experience
    public function updateWorkExp(Request $request, UpdateUserWorkExperience $updateUserWorkExperience)
    {
        $update = $updateUserWorkExperience->handle($request);
        return $update;
    }

}
