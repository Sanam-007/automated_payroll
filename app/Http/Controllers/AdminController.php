<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Category;
use App\Models\employeeposition;
use App\Models\Position;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PositionCategory;
use Session;
use DB;
class AdminController extends Controller

{     //*ADMIN DASHBOARD*
    public function admindashboard(){
        
         $id = Session::get('id');
         $admin= Admin::find($id);
        //echo $admin->name;
         return view ('admin.admin',compact('admin'));
    } 
    
    //DISPLAYE EMPLOYEE LIST
    public function generate_view(){
             $employees=Employee::all();
            $data=compact('employees');
             return view('admin.display_employees')->with($data);
                
          }

  //generate salary
    public function generatesalary1(){
            $employees=Employee::all();
           $data=compact('employees');
            return view('admin.generate_salary1')->with($data);
                
         }

        //create category page 
        public function createCategory(){
        return view('admin.create_category');
        }



        //category insert
        public function insertCategory(Request $request){
            $name=$request->category;
            $amount=$request->amount;
            $obj=new Category();
            $obj->name = $name;
            $obj->amount = $amount;
            $obj->status=1;
            if($obj->save()){
                return redirect()->to('create-category');
            }
        }

        
        //create position page 
        public function createPosition(){
            return view('admin.create_position');
               
            }

        
        //insert position
        public function insertPosition(Request $request){
                $name=$request->position;
                echo $name;
                $obj=new Position();
                $obj->name = $name;
               
                $position=Position::where('name','=',$name)
                ->first();
                if(!$position){
                    $obj->save();
                    //return redirect()->to('admin.create_position') ;
                    
                }
                else{
                    return redirect()->back()->with('err_msg','name already exist');
                    
                }
        }

        //create employee
        public function employeeCreate(){
            $positions = Position::all();
            return view('admin.add_employee',compact('positions'));
        }   





        //dlt employee
        public function deleteEmployee($id){
            $employees= Employee::find($id);
            echo $id;
             if(!is_null($employees)){
                 $employees->delete();
             }
             return redirect()->to('display_employees');
    
        }

        //edit employee
        public function edemployee($id){
                    $employee= Employee::find($id);
                    echo $id;
                    if(is_null($employee)){
                        return redirect()->to('display_employees');
    
                    }
                    else{
                        
                        $data=compact('employee');
                         return view ('admin.employee_update')->with($data);
                       
                    }
                }

         //update employee       
                public function updateEmloyee($id,Request $r){
                    $employees= Employee::find($id);
                    $employees->name=$r['name'];
                    $employees->address=$r['address'];
                    $employees->email=$r['email'];
                    $employees->contact_no=$r['contact'];
                    $employees->save();
                    return redirect()->to('display_employees') ;
                }


                



                 //category show

                public function Category(){
                    $categories=Category::all();
                    $data=compact('categories');
                    return view('admin.show_category')->with($data);
                }



                //edit category
                public function edCategory($id){
                    $category= Category::find($id);
                    // echo $id;
                    if(is_null($category)){
                        return redirect()->to('category');
    
                    }
                    else{
                        
                        $data=compact('category');
                         return view ('admin.edit_category')->with($data);
                        
    
                    }
                }
                //update category
                public function updateCategory($id,Request $r){
                    $category= Category::find($id);
                    $category->name=$r['name'];
                    $category->amount=$r['amount'];

                    $category->save();
                    
                    return redirect()->to('category') ;
                }
               
                //delete category
                public function deleteCategory($id){
                    $category= Category::find($id);
                    echo $id;
                     if(!is_null($category)){
                         $category->delete();
                     }
                     return redirect()->to('category');
            
                }
                //edit position
                public function edPosition($id){
                    $position= Position::find($id);
                    $data=compact('position');

                    $categories = DB::table('position_categories')
                    ->join('categories', 'position_categories.category_id', '=', 'categories.id')
                    ->where('position_categories.position_id','=',$id)
                    ->select('categories.*')
                    ->get();
                    //dd($categories);
                    $category = Category::all();
                    
                    return view('admin.edit_position',compact('category','position','categories'));
                    //return view ('admin.edit_position')->with($data);
                        
    
                    
                }
               /// update position particular not include employee position 
                public function positionUpdated($id,Request $r){
                    $pos=Position::find($id);
                    $pos->name = $r->name;
                    $pos->save();

                    DB::table('position_categories')->where('position_id', $id)->delete();
                   // $poscat = positionCategory::where('position_id','=',$id)->first();
                   
                    foreach($r->category as $c){
                        $poscat = new PositionCategory();
                        $poscat->position_id = $id;
                        $poscat->category_id = $c;
                        $poscat->save();
                    }
                    return redirect('position');
                   
                }

                //dlt position
                public function deletePosition($id){
                    $position= Position::find($id);
                    echo $id;
                     if(!is_null($position)){
                         $position->delete();
                     }
                     return redirect('position');
            
                }




                 //change position
                 public function changePosition($id){
                    $employee=Employee::find($id);
                    $positions = Position::all();
                    $ap = employeeposition::where('employee_id','=',$id)
                    ->first();
                    return view('admin.change_position',compact('employee','positions','ap'));

                }
               //update position
                public function updatePosition($id, Request $r){
                    $emppos = Employeeposition::where('employee_id','=',$id)->first();
                    $emppos->position_id = $r['position'];
                    
                    $emppos->save();
                    
    
                    return redirect()->to('employee-postions') ;

                }



               //show position
              public function Position(){
                    $positions=Position::all();
                    $sal = array();
                    
                    foreach($positions as $pos){
                        
                            $s = 0;
                            $salary = PositionCategory::selectRaw('sum(categories.amount) AS salary')
                                    ->join('categories', 'categories.id', '=', 'position_categories.category_id')
                                    ->where('position_id',$pos->id)
                                    
                                    ->get();
                                        
                            if($salary[0]->salary!=null) {
                                $s = $salary[0]->salary;
                            }
                                
                               
                        
                        array_push($sal,$s);
                        //echo $pos->name . " -> ".$i. " -> ".$sal[$i]."<br>";
                       

                    }

             
                    return view('admin.show_position',compact('positions','sal'));
                    /*$i=0;
                    foreach($positions as $d ){
                        
                        //echo $d[0]->name."->".$d[1]."<br>";
                        
                        echo $d->name."<->".$sal[$i]."<br>";
                        $i++;
                    }*/
                }







                public function generatePdf($id){
                    //echo $id;
                    $data= Employee::find($id);

                    $pdf = Pdf::loadView('admin.employee_pdf', compact('data'));
                    return $pdf->download('employee.pdf');
                }

                public function generatePdf2(){
                    //echo $id;
                    $data= Employee::all();
                    //return view('admin.em-pdf',compact('data'));
                    $pdf = Pdf::loadView('admin.em-pdf', compact('data'));
                    //return view('admin.em-pdf');
                    return $pdf->download('employee.pdf');
                }

                public function downloadPdf(){

                }

                public function employeeStore(Request $request){
                    $name=$request->name;
                    $email=$request->email;
                    $address=$request->address;
                    $contact_no=$request->contact_no;
                    $pass=$request->password;
                    $joining_date = now();

                    $obj=new Employee();
                    $obj->name = $name;
                    $obj->email = $email;
                    $obj->password = $pass;
                    $obj->address = $address;
                    $obj->contact_no = $contact_no;
                    $obj->joining_date = $joining_date;
                    $obj->image="user.png";
                    if($obj->save()){
                        $emp = Employee::latest()->first();
                        $emppos = new employeeposition();
                        $emppos->employee_id = $emp->id;
                        $emppos->position_id = $request->position;
                        $emppos->save();
                        echo "successfully inserted";
                        return redirect('display_employees');
                    }
                } 
                public function employeePosition(){
                    $employees=employeePosition::join('employees','employeepositions.employee_id','employees.id')
                                               ->join ('positions','employeepositions.position_id','positions.id')
                                               ->select('employees.image as image','employees.name as name', 'employees.id as id', 'positions.name as position','positions.id as pid')
                                               ->get();
                    //dd($employees);
                   return view('admin.employee_position',compact('employees'));
                   //foreach($employees as $employee){
                    //echo $employee->id." ".$employee->name." ".$employee->position."<br>";
                  // }

                }
                 public function positionCategory(){
                    $d=PositionCategory::all();
                    dd($d);
                 }





                 

                 public function pass(){
                   
                    return view ('admin.pass_change');
                       
                    
                }
                public function updatepass(Request $r){
                    $id = Session::get('id');
                    $ad= Admin::find($id);
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




}
