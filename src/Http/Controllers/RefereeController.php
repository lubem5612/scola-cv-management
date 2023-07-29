<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Referees\CreateReferee;
use Transave\ScolaCvManagement\Actions\Referees\DeleteReferee;
use Transave\ScolaCvManagement\Actions\Referees\UpdateReferee;
use Transave\ScolaCvManagement\Actions\Referees\SearchReferees;
use Transave\ScolaCvManagement\Actions\Referees\SingleUserReferees;
use Transave\ScolaCvManagement\Actions\Referees\AllUsersRefereesList;
use Transave\ScolaCvManagement\Http\Models\Referee;


class RefereeController extends Controller
{
    public function index()
    {
        return (new SearchReferees(Referee::class, ['cv']))->execute();
    }


    public function store(Request $request)
    {
        return (new CreateReferee($request->all()))->execute();
    }


    public function show($cv_id)
    {
        return (new SingleUserReferees(['cv_id' => $cv_id]))->execute();
    }


    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['referee_id' => $id]);
        return (new UpdateReferee($data))->execute();
    }


    public function delete($id)
    {
        return (new DeleteReferee(['referee_id' => $id]))->execute();
    }


}