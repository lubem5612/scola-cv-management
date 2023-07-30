<?php


namespace Transave\ScolaCvManagement\Http\Controllers;


use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\User\DeleteUser;
use Transave\ScolaCvManagement\Actions\User\SearchUser;
use Transave\ScolaCvManagement\Actions\User\UpdateUser;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index', 'show']);
    }

    /**
     * Get a listing of users
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return (new SearchUser(config('scolacv.auth_model'), ['school', 'department', 'origin', 'residence', 'lgOfOrigin', 'lgOfResidence']))->execute();
    }

    /**
     * Get a specified user
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new SearchUser(config('scolacv.auth_model'), ['school', 'department', 'origin', 'residence', 'lgOfOrigin', 'lgOfResidence'], $id))->execute();
    }

    /**
     * Update a specified user
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['user_id' => $id]);
        return (new UpdateUser($data))->execute();
    }

    /**
     * Delete a specified user
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (new DeleteUser(['user_id' => $id]))->execute();
    }
}