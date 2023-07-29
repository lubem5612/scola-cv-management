<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Specialization\CreateSpecialization;
use Transave\ScolaCvManagement\Actions\Specialization\DeleteSpecialization;
use Transave\ScolaCvManagement\Actions\Specialization\UpdateSpecialization;
use Transave\ScolaCvManagement\Actions\Specialization\SearchSpecialization;
use Transave\ScolaCvManagement\Actions\Specialization\SingleUserSpecializations;
use Transave\ScolaCvManagement\Actions\Specialization\AllUsersSpecializationList;
use Transave\ScolaCvManagement\Http\Models\Specialization;


class SpecializationController extends Controller
{
    public function index()
    {
        return (new SearchSpecialization(Specialization::class, ['cv']))->execute();
    }


    public function store(Request $request)
    {
        return (new CreateSpecialization($request->all()))->execute();
    }


    public function show($cv_id)
    {
        return (new SingleUserSpecializations(['cv_id' => $cv_id]))->execute();
    }


    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['specialization_id' => $id]);
        return (new UpdateSpecialization($data))->execute();
    }


    public function delete($id)
    {
        return (new DeleteSpecialization(['id' => $id]))->execute();
    }

}