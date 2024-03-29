<?php
namespace Transave\ScolaCvManagement\Http\Controllers;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Publication\CreatePublication;
use Transave\ScolaCvManagement\Actions\Publication\DeletePublication;
use Transave\ScolaCvManagement\Actions\Publication\SearchPublication;
use Transave\ScolaCvManagement\Actions\Publication\UpdatePublication;
use Transave\ScolaCvManagement\Http\Models\Publication;


class PublicationController extends Controller
{
    /**
     * PublicationController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index', 'show']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        return (new SearchPublication(Publication::class, ['cv']))->execute();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new CreatePublication($request->all()))->execute();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new SearchPublication(Publication::class, ['cv'], $id))->execute();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['publication_id' => $id]);
        return (new UpdatePublication($data))->execute();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (new DeletePublication(['publication_id' => $id]))->execute();
    }

}