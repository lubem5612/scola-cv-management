<?php

namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Http\Models\Gallery;
use function response;
use function view;

class PhotoController extends Controller
{
    public function index()
    {
        return view('photo');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        $data = Gallery::create([
            'image' => $image_path,
        ]);

        return response()->json([
            "status" =>200,
            "message" => 'Image Upload successfully'
        ]);
    }
}