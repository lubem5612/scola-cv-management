<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Publication\CreatePublication;
use Transave\ScolaCvManagement\Actions\Publication\DeletePublication;
use Transave\ScolaCvManagement\Actions\Publication\GetPublicationByID;
use Transave\ScolaCvManagement\Actions\Publication\SearchPublication;
use Transave\ScolaCvManagement\Actions\Publication\SingleUserPublicationList;
use Transave\ScolaCvManagement\Actions\Publication\UpdatePublication;
use Transave\ScolaCvManagement\Http\Models\Publication;


class PublicationController extends Controller
{

    public function index()
    {
        return (new SearchPublication(Publication::class, ['cv']))->execute();
    }


    public function store(Request $request)
    {
        return (new CreatePublication($request->all()))->execute();
    }


    public function show($id)
    {
        return (new GetPublicationByID(['id' => $id]))->execute();
    }


    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['publication_id' => $id]);
        return (new UpdatePublication($data))->execute();
    }


    public function destroy($id)
    {
        return (new DeletePublication(['id' => $id]))->execute();
    }


    public function showUserPublications($cv_id)
    {
        return (new SingleUserPublicationList(['cv_id' => $cv_id]))->execute();
    }

}