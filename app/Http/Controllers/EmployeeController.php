<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Session;
use DB;
use File;
use App\Models\Employee;
use App\Models\employeeposition;
use App\Models\Position;
class EmployeeController extends Controller
{
    public function employeedashboard(){
        $id = Session::get('id');
        $employee= Employee::find($id);
        $position = employeeposition::where('employee_id','=',$id)->first();
        $pos = Position::find($position->position_id);
        //$data=compact('employee');
        return view ('employee.employee',compact('employee','pos'));
    } 



    public function edemployee(){
        $id = Session::get('id');
        $employee= Employee::find($id);
        
                        
            $data=compact('employee');
             return view ('employee.employee_update')->with($data);
           
        
    }
    public function upEmloyee(Request $r){
        $id = Session::get('id');
        $employees= Employee::find($id);
        $employees->name=$r['name'];
        $employees->address=$r['address'];
        $employees->email=$r['email'];
        $employees->contact_no=$r['contact'];
        $employees->save();
        return redirect()->to('employee') ;
    }
    


    
    public function updatePassword(){
        return view ('employee.employee_pass');
   
        
    }
    
    public function updatepass(Request $r){
        $id = Session::get('id');
        $ad= Employee::find($id);
        if($ad->password==$r['pass1']){
            if($r['pass2']==$r['pass3']){
                $ad->password=$r['pass2'];
                $ad->save();
                return redirect()->back()->with('scs_msg','password successfully updated');
            }
            else{
                return redirect()->back()->with('err_msg','new passwords doesn\'t matched');
            }
        }
        else{
            return redirect()->back()->with('err_msg','Wrong old password');
        }
        
    }




    public function uploadImage(){
        return view ('image');
    }
    public function storeImage(Request $r){
       $id = Session::get('id');
       
       $originalImage = $r->file('fileToUpload');
       //dd($originalImage);
       $thumbnailImage = Image::make($originalImage);

       $thumbnailPath = public_path().'/thumbnail/';
       $originalPath = public_path().'/image/';

       //rename image;
       $temp = $originalImage->getClientOriginalName();
       $temp_ext=(explode(".",$temp));
       $ext = end($temp_ext);
       $filename = time().'.'.$ext;

        $thumbnailImage->save($originalPath.$filename);
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.$filename);

        //rename image
        echo $filename;
        $employees= Employee::find($id);
        $old_img = $employees->image;
        if($old_img!='user.png'){
            if(File::exists(public_path('image/'.$old_img))){
                File::delete(public_path('image/'.$old_img));
            }
            if(File::exists(public_path('thumbnail/'.$old_img))){
                File::delete(public_path('thumbnail/'.$old_img));
            }
        }

        $employees->image=$filename;

        $employees->save();
        return redirect()->to('employee') ;

    }
    public function showSalary(){
        $id = Session::get('id');

        $data = DB::table('generate_salaries')->join('employees','generate_salaries.employee_id','employees.id')
                                      ->join ('positions','generate_salaries.position_id','positions.id')
                                        ->select('employees.name as name','positions.name as position', 'amount','generate_salaries.updated_at')
                                        ->where('generate_salaries.employee_id','=',$id)
                                        ->orderBy('generate_salaries.id', 'DESC')
                                        ->get();
      
        //$data=compact('employee');
        return view ('employee.show_salary',compact('data'));
    } 

}
