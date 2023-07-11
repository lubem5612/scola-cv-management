<?php
namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\User\Achievement\CreateAchievement;
use Transave\ScolaCvManagement\Actions\User\Achievement\DeleteAchievement;
use Transave\ScolaCvManagement\Actions\User\Achievement\ViewAllAchievement;
use Transave\ScolaCvManagement\Actions\User\Achievement\UpdateAchievement;



class UserAchievementController extends Controller
{

    // Create Achievement
    public function registerAch(Request $request, CreateAchievement $createAchievement)
    {
        $create = $createAchievement->handle($request);
        return $create;
    }


    // Update Achievement
    public function updateAch(Request $request, UpdateAchievement $updateAchievement)
    {
        $update = $updateAchievement->handle($request);
        return $update;
    }


    // View All Achievement
    public function viewAllAch(Request $request, ViewAllAchievement $viewAllAchievement)
    {
        $all = $viewAllAchievement->handle($request);
        return $all;
    }


    // Delete Achievement
    public function deleteAch(Request $request, DeleteAchievement $deleteAchievement)
    {
        $delete = $deleteAchievement->handle($request);
        return $delete;
    }
}
