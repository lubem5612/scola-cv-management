<?php

namespace Transave\ScolaCvManagement\Http\Controllers;


use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Credential\CreateCredential;
use Transave\ScolaCvManagement\Actions\Credential\DeleteCredential;
use Transave\ScolaCvManagement\Actions\Credential\SearchCredential;
use Transave\ScolaCvManagement\Actions\Credential\UpdateCredential;
use Transave\ScolaCvManagement\Http\Models\Credential;

class CredentialController extends Controller
{
    /**
     * CredentialController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return (new SearchCredential(Credential::class, ['cv']))->execute();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new CreateCredential($request->all()))->execute();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new SearchCredential(Credential::class, ['cv'], $id))->execute();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['credential_id' => $id]);
        return (new UpdateCredential($data))->execute();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (new DeleteCredential(['credential_id' => $id]))->execute();
    }
}