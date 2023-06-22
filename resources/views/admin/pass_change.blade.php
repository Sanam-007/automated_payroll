<!DOCTYPE html>
<html lang="en">
<head>
@include('employee.includes.head')
</head>
<body>
<div class="container" style="background-color:#44e0e680" >
        <div class="row text-center" >
        <h2 class="mt-3"  style="margin-left:450px" >Change Password </h2>
            
        </div>
        <div class="col-md-9" >
        <div class="row-md-3" >
        
</div>   
    </div>
<div class="row mt-2 p-3" style="background-color:#44e0e680">
            <div class="col-md-3">
                @include('admin.includes.sidebar')
            </div>
            <div class="col-md-9">
            
            <div class="col-md-9">
                <div class="card" style="width: 40rem; background-color:white">
                    <form class="form-horizontal" action="{{URL::to('update-pass')}}">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Actual Password</label>
                            <div class="col-sm-10">
                            <input type="text" name="pass1" class="form-control" id="pass1" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">New Password</label>
                            <div class="col-sm-10">
                            <input type="text" name="pass2" class="form-control" id="pass2" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Retype new password</label>
                            <div class="col-sm-10">
                            <input type="text" name="pass3" class="form-control" id="pass3" placeholder="confirm password">
                            </div>
                        </div>

                        @if(Session::has('scs_msg'))
                            <span class="text-success" >
                                {{Session::get('scs_msg')}}
                            </span>

                        @endif
                        @if(Session::has('err_msg'))
                            <span class="text-danger" >
                                {{Session::get('err_msg')}}
                            </span>

                        @endif
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            
                  
                  </div>
                  

                  </div>
            
    
</body>
</html>

