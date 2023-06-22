<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employee list</title>
</head>
<body>

       
            <table>
        
        <tbody>
        <thead>
                      <tr>
                        
                        <th>name</th>
                        <th>address</th>
                        <th>email</th>
                        <th>contact_no</th>
                       

                      </tr>
                    </thead>

            @foreach($data as $employee)
            
            <tr>

                
                
                <td>{{$employee->name}} </td>
                <td>{{$employee->address}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->contact_no}}</td>
               
            </tr>   
            @endforeach
            
            
        </tbody>
      </table>

</body>
</html>