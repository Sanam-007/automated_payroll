<table class="table table-dark">
                    <thead>
                        <tr >
                            <th> Employee panel</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                            <td><a href="{{URL::to('employee')}}">Employee dashboard</td>
                        </tr>
                        <tr>
                            <td><a href="{{URL::to('show-salary')}}">Employee salary</td>
                        </tr>
                       
                        
                        <tr>
                            <td><a href="{{URL::to('emp-pass-change')}}">Change password</td>
                        </tr>
                        <tr>
                            <td><a href="{{URL::to('employee-edit')}}">Update your info</td>
                        </tr>
                        <tr>
                            <td><a href="{{URL::to('upload-image')}}">Upload image</td>
                        </tr>
                        <tr>
                            <td><a href="{{URL::to('logout')}}">Log out</td>
                        </tr>
                    </tbody>
                    
                </table>