<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\WorkExperience\CreateWorkExperience;
use Transave\ScolaCvManagement\Actions\WorkExperience\DeleteWorkExperience;
use Transave\ScolaCvManagement\Actions\WorkExperience\SingleUserWorkExperience;
use Transave\ScolaCvManagement\Actions\WorkExperience\SearchWorkExperience;
use Transave\ScolaCvManagement\Actions\WorkExperience\UpdateWorkExperience;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;


class WorkExperienceController extends Controller
{

    public function index()
    {
        return (new SearchWorkExperience(WorkExperience::class, ['cv']))->execute();
    }


    public function store(Request $request)
    {
        return (new CreateWorkExperience($request->all()))->execute();
    }


    public function show($cv_id)
    {
        return (new SingleUserWorkExperience(['cv_id' => $cv_id]))->execute();
    }


    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['workexperience_id' => $id]);
        return (new UpdateWorkExperience($data))->execute();
    }


    public function delete($id)
    {
        return (new DeleteWorkExperience(['id' => $id]))->execute();
    }

}