<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\School\CreateSchool;
use Transave\ScolaCvManagement\Actions\School\DeleteSchool;
use Transave\ScolaCvManagement\Actions\School\UpdateSchool;
use Transave\ScolaCvManagement\Actions\School\SearchSchool;
use Transave\ScolaCvManagement\Actions\School\RegisteredSchools;
use Transave\ScolaCvManagement\Http\Models\School;


class SchoolController extends Controller
{

    public function search()
    {
        return (new SearchSchool(School::class, ['name']))->execute();
    }

    public function store(Request $request)
    {
        return (new CreateSchool($request->all()))->execute();
    }


    public function show(Request $request, RegisteredSchools $registeredSchools)
    {
        $school = $registeredSchools->$request->execute();
        return $school;
    }


    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['id' => $id]);
        return (new UpdateSchool($data))->execute();
    }


    public function delete($id)
    {
        return (new DeleteSchool(['id' => $id]))->execute();
    }

}