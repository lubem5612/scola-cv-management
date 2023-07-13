<?php
namespace Transave\ScolaCvManagement\Actions\Admin\Qualifications;

use Illuminate\Http\Request;
use Transave\ScolaCvManagement\Http\Models\Qualification;

class  ViewAllRegisteredQualifications
{
    public function handle(Request $request)
    {
        $data['qualification'] = Qualification::all();
        return response()->json([
            'status' => 200,
            'message' => "List of Registered Qualification",
            'data' => $data
        ]);

    }
}
