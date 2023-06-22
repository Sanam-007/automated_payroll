<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
</head>
<body>
<div class="container" style="background-color:#44e0e680" >
        <div class="row" >
            <h2 class="mt-3"  style="margin-left:450px" >All position list</h2>
            
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
            <table class="table">
        
        <tbody>
            <thead>
                <tr>
                
                <th>Position</th>
                <th>Total pay</th>
                <th>Action</th>
                
                
                </tr>
            </thead>

            @foreach($positions as $index => $pos)
            
            <tr>

                <td>{{$pos->name}} </td>
                <td>{{$sal[$index]}} </td>
                <td>
                    <button type="button" class="btn btn-success"> <a href ="{{URL::to('edit-position/'.$pos->id)}}"><b>Edit</b></button>             
                                    
                <button type="button" class="btn btn-danger"> <a href ="{{URL::to('delete-position/'.$pos->id)}}"><b>Delete</b></button>
                </td> 
            </tr>   
            @endforeach
            
        </tbody>
      </table>
            </div>
        </div>
    </div>
      

    
  
    </div>
    </div>
</body>
</html>