<!DOCTYPE html>
<html lang="en">
<head>
@include('employee.includes.head')
</head>
<body>
<div class="container" style="background-color:#44e0e680" >
        <div class="row text-center" >
            <h2 class="text-center">Employee dashboard</h2>
        </div>
        <div class="col-md-9" >
        <div class="row-md-3" >
        
</div>   
    </div>
    
<div class="row mt-2 p-3" style="background-color:#44e0e680">
            <div class="col-md-3">
                @include('employee.includes.sidebar')
            </div>
            
            <form action="" >
    @csrf
   

    <img src="{{ URL::to('/') }}/thumbnail/{{$employee->image}}" alt="">
  
  <div class="form-group">
                            
  <div class="form-group">
    <label for="contact"><b> Name:</b>{{$employee->name}}</label>
    
  </div>
  <div class="form-group">
    <label for="contact"><b>Adress:</b>{{$employee->address}}</label>
    
  </div>
  <div class="form-group">
    <label for="contact"><b>Email:</b>{{$employee->email}}</label>
   
  </div>
  <div class="form-group">
    <label for="contact"><b>Contact_no:</b>{{$employee->contact_no}}</label>
    
  </div>
  <div class="form-group">
    <label for="contact"><b>Position_no:</b>{{$pos->name}}</label>
    
  </div>
  
  
    </div>
  
 
  
</form>
                  
            </div>
                  

 </div>
            
    
</body>
</html>

