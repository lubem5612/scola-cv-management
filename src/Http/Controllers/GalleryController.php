<?php


namespace Transave\ScolaCvManagement\Http\Controllers;


use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Actions\Gallery\CreateGallery;
use Transave\ScolaCvManagement\Actions\Gallery\DeleteGallery;
use Transave\ScolaCvManagement\Actions\Gallery\SearchGallery;
use Transave\ScolaCvManagement\Actions\Gallery\UpdateGallery;
use Transave\ScolaCvManagement\Http\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * GalleryController constructor.
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
        return (new SearchGallery(Gallery::class, ['cv']))->execute();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return (new CreateGallery($request->all()))->execute();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new SearchGallery(Gallery::class, ['cv'], $id))->execute();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_merge($request->all(), ['gallery_id' => $id]);
        return (new UpdateGallery($data))->execute();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (new DeleteGallery(['gallery_id' => $id]))->execute();
    }
}