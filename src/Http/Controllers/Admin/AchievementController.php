<?php
namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\Admin\Achievement\CreateUserAchievement;
use Transave\ScolaCvManagement\Actions\Admin\Achievement\DeleteUserAchievement;
use Transave\ScolaCvManagement\Actions\Admin\Achievement\UpdateUserAchievement;
use Transave\ScolaCvManagement\Actions\Admin\Achievement\ViewUserAchievements;
use Transave\ScolaCvManagement\Actions\Admin\Achievement\RegisteredAchievements;


class AchievementController extends Controller
{

    // Create Achievement
    /**
     * Register a new Achievement
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Transave\ScolaCvManagement\Helpers\Response
     */
    public function registerUserAch(Request $request)
    {
        return (new CreateUserAchievement($request->all()))->execute();
    }



    // Delete User Achievement
    public function deleteUserAch(Request $request, DeleteUserAchievement $deleteUserAchievement)
    {
        $delete = $deleteUserAchievement->handle($request);
        return $delete;
    }



    // view  User Achievement
    public function viewUserAch(Request $request, RegisteredAchievements $registeredAchievements)
    {
        $update = $registeredAchievements->handle($request);
        return $update;
    }


    // Update User Achievement
    public function updateUserAch(Request $request, UpdateUserAchievement $updateUserAchievement)
    {
        $update = $updateUserAchievement->handle($request);
        return $update;
    }


    // View Single Achievement
    public function viewSingleAch(Request $request, ViewUserAchievements $viewUserAchievementDetails)
    {
        $details = $viewUserAchievementDetails->handle($request);
        return $details;
    }

}
