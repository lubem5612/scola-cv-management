<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Achievement\CreateAchievement;
use Transave\ScolaCvManagement\Actions\Achievement\DeleteAchievement;
use Transave\ScolaCvManagement\Actions\Achievement\GetAchievementByID;
use Transave\ScolaCvManagement\Actions\Achievement\SearchAchievement;
use Transave\ScolaCvManagement\Actions\Achievement\SingleUserAchievementList;
use Transave\ScolaCvManagement\Actions\Achievement\UpdateAchievement;
use Transave\ScolaCvManagement\Http\Models\Achievement;


class AchievementController extends Controller
{

    public function index()
    {
        return (new SearchAchievement(Achievement::class, ['cv']))->execute();
    }


    public function store(Request $request)
    {
        return (new CreateAchievement($request->all()))->execute();
    }


    public function show($id)
    {
        return (new GetAchievementByID(['id' => $id]))->execute();
    }


    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['achievement_id' => $id]);
        return (new UpdateAchievement($data))->execute();
    }


    public function delete($id)
    {
        return (new DeleteAchievement(['id' => $id]))->execute();
    }


    public function showUserPublications($cv_id)
    {
        return (new SingleUserAchievementList(['cv_id' => $cv_id]))->execute();
    }

}