<?php
namespace Transave\ScolaCvManagement\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Transave\ScolaCvManagement\Actions\User\EducationalQualification\AddQualification;
use Transave\ScolaCvManagement\Actions\User\EducationalQualification\DeleteQualification;
use Transave\ScolaCvManagement\Actions\User\EducationalQualification\UpdateQualification;
use Transave\ScolaCvManagement\Actions\User\EducationalQualification\ViewAllQualifications;



class EducationalQualificationController extends Controller
{

    // Create Achievement
    public function AddQuali(Request $request, AddQualification $addQualification)
    {
        $create = $addQualification->handle($request);
        return $create;
    }


    // Update Achievement
    public function deleteQuali(Request $request, DeleteQualification $deleteQualification)
    {
        $delete = $deleteQualification->handle($request);
        return $delete;
    }


    // View All Achievement
    public function viewAllQuali(Request $request, ViewAllQualifications $viewAllQualifications)
    {
        $all = $viewAllQualifications->handle($request);
        return $all;
    }


    // Delete Achievement
    public function editSpec(Request $request, UpdateQualification $updateQualification)
    {
        $edit = $updateQualification->handle($request);
        return $edit;
    }
}
