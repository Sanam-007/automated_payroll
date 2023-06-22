<!DOCTYPE html>
<html lang="en">
<head>
    @include('employee.includes.head')
</head>
<body>
<div class="container" style="background-color:#44e0e680" >
        <div class="row" >
            <h2 class="mt-3"  style="margin-left:450px" >Show User Salary</h2>
            
        </div>
        <div class="col-md-9" >
        <div class="row-md-3" >
        
     </div>   
    </div>
    <div class="row mt-2 p-3" style="background-color:#44e0e680">
            <div class="col-md-3">
            @include('employee.includes.sidebar')
            </div>
            <div class="col-md-9">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>Employee_Name </th>
                        <th>Position</th>
                        <th>Amount</th>
                        <th>Credited at</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach($data as $employee)
                    
                    <tr>
                        <td>{{$employee->name}} </td>
                        <td>{{$employee->position}}</td>
                        <td>{{$employee->amount}}</td>
                        <td>{{$employee->updated_at}}</td>

                    </tr>   
                    @endforeach
                    
                
                </tbody>
      </table>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script >
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
      
            </div>
        </div>
    </div>
      

    
  
    </div>
    </div>
</body>
</html>
