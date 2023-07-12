<?php
//namespace Transave\ScolaCvManagement\Actions\User\CredentialsUpload;
//
//use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
//use Transave\ScolaCvManagement\Http\Models\Credential;
//
//class FileUploadController extends Controller
//{
//
//    public function storeImage(Request $request){
//        $data= new Credential();
//
//        if($request->file('image')){
//            $file= $request->file('image');
//            $filename= date('YmdHi').$file->getClientOriginalName();
//            $file-> move(public_path('public/Document'), $filename);
//            $data['image']= $filename;
//        }
//        $data->save()->where('user_id', $request->user_id)->first();;
//        return response()->json([
//            'Status'=>200,
//            'Message'=> 'File upload successfully',
//            'data'=>
//        ]);
//
//    }
//}