<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\File; 
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class studentController extends Controller
{
    public function stdListing(){
        // $stdListing = student::all();
        //  $stdListing = student::latest()->paginate(5);
        // $stdListing = DB::table('students')->latest()->get();
        $stdListing = DB::table('students')->latest()->paginate(5);
        return view('index', compact('stdListing')); 
    }
    public function addPageView(){
        return view('addStudent');
    }

    public function storestudentdetials(Request $request){
       $validated = $request->validate([
        'name'      => 'required',
        'email'     => 'required|email|unique:students,email',
        'mobile'    => 'required|numeric|unique:students,mobile',
        'gender'    => 'required|in:M,F,O',
        'img'       => 'required|mimes:jpeg,jpg,png|max:50'
       ]);
       if($request->file('img')){
            $image = $request->file('img');
            $img_path = uniqid().'.'.$image->getClientOriginalExtension();
            $save_img_path = 'upload/'.$img_path;
       }
    //    $data = new student;
    //    $data->name = $request->name;
    //    $data->email = $request->email;
    //    $data->mobile = $request->mobile;
    //    $data->gender = $request->gender;
    //    $data->img = $save_img_path;
    //    if($data->save()){
    //     $image->move(public_path('upload'),$img_path);
    //     return redirect()->route('stdListing')->with('message', 'Student Data Successfully Added');
    //    }
        // $insertVal = student::insert([
        //     'name'          => $request->name,
        //     'email'         => $request->email,
        //     'mobile'        => $request->mobile,
        //     'gender'        => $request->gender,
        //     'img'           => $save_img_path,
        //     'created_at'   => Carbon::now()
        // ]);
        // if($insertVal){
        //     $image->move(public_path('upload'), $img_path);
        //     return redirect()->route('stdListing')->with('message', 'Student Data Successfully Added');
        // }
        $data = array();
        $data['name']   = $request->name;
        $data['email']  = $request->email;
        $data['mobile'] = $request->mobile;
        $data['gender'] = $request->gender;
        $data['img']    = $save_img_path;
        $insertVal = DB::table('students')->insert($data);
        if($insertVal){
            $image->move(public_path('upload'), $img_path);
            return redirect()->route('stdListing')->with('message', 'Student Data Successfully Added');
        }
    }
    public function stdEdit($id){
        // $stdEditData = student::find($id);
        $stdEditData = DB::table('students')->get();
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
            $stdEditAllData->gender = $request->gender;
            $stdEditAllData->img = $editImgURL;
            if($stdEditAllData->save()){
                $editImg->move(public_path('upload'), $editImgURL);
                return redirect()->route('stdListing')->with('message', 'Student Details is Updated');
            }
       }else{
            $stdEditAllData->name = $request->name;
            $stdEditAllData->email = $request->email;
            $stdEditAllData->mobile = $request->mobile;
            $stdEditAllData->gender = $request->gender;
            if( $stdEditAllData->save()){
                return redirect()->route('stdListing')->with('message', 'Student Details is Updated');
            }
       }

    }

}
