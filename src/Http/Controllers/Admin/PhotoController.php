<?php

namespace Transave\ScolaCvManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Http\Models\Photos;


class PhotoController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        $data = Photos::create(['image' => $image_path ]);

        return response()->json([
            "status" =>200,
            "message" => 'Image Upload successfully'
        ]);
    }
}