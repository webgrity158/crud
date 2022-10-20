<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\File; 

class studentController extends Controller
{
    public function stdListing(){
        $stdListing = student::all();
        return view('index', compact('stdListing')); 
    }
    public function addPageView(){
        return view('addStudent');
    }

    public function storestudentdetials(Request $request){
       $validated = $request->validate([
        'name'      => 'required',
        'email'     => 'required|email',
        'mobile'    => 'required|numeric',
        'img'       => 'required'
       ]);
       if($request->file('img')){
            $image = $request->file('img');
            $img_path = uniqid().'.'.$image->getClientOriginalExtension();
            $save_img_path = 'upload/'.$img_path;
       }
       $data = new student;
       $data->name = $request->name;
       $data->email = $request->email;
       $data->mobile = $request->mobile;
       $data->img = $save_img_path;
       if($data->save()){
        $image->move(public_path('upload'),$img_path);
        return redirect()->route('stdListing')->with('message', 'Student Data Successfully Added');
       }
    }
    public function stdEdit($id){
        $stdEditData = student::find($id);
        return view('stdeditview', compact('stdEditData'));
    }
    public function stdDelete($id){
        $stdDelete = student::find($id);
        File::delete($stdDelete->img);
        $stdDelete->delete();
        return redirect()->back()->with('message', 'Stduent Data is Deleted');
    }
    public function stdEditDataStore(Request $request, $id){
       $validated = $request->validate([
            'name'  => 'required',
            'email'     => 'required|email',
            'mobile'    => 'required|numeric',
       ]);
       $stdEditAllData = student::find($id);
       if($request->file('img')){
            File::delete($stdEditAllData->img);
            $editImg = $request->file('img');
            $editImg_filename = uniqid().'.'.$editImg->getClientOriginalExtension();
            $editImgURL = 'upload/'.$editImg_filename;
            $stdEditAllData->name = $request->name;
            $stdEditAllData->email = $request->email;
            $stdEditAllData->mobile = $request->mobile;
            $stdEditAllData->img = $editImgURL;
            if($stdEditAllData->save()){
                $editImg->move(public_path('upload'), $editImgURL);
                return redirect()->route('stdListing')->with('message', 'Student Details is Updated');
            }
       }else{
            $stdEditAllData->name = $request->name;
            $stdEditAllData->email = $request->email;
            $stdEditAllData->mobile = $request->mobile;
            if( $stdEditAllData->save()){
                return redirect()->route('stdListing')->with('message', 'Student Details is Updated');
            }
       }

    }
}
