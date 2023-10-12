<!DOCTYPE html>
<html>
   <head>
   <script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script>
       $(document).ready(function() {
         $('#table').DataTable();
       });
    </script>
   </head>
   <body>
      <div>
         <table id="table" class="table">
            <thead>
               <tr>
                  <th>Campus Code</th> <th>Group Number</th> <th>Department Group Name</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
               <tr>
                  <td>{{$item->campus_code}}</td>
                  <td>{{$item->dept_grp}}</td>
                  <td>{{$item->dept_grp_name}}</td>
                  <td>
                     <a href="{{ route('dept_group.index')}}"
                        onclick="event.preventDefault();
                        document.getElementById(
                           'delete-form-{{$item->dept_grp}}').submit();">
                           <button class='delete-modal btn btn-danger' ><span class='glyphicon glyphicon-trash'></span></button>
                     </a>
                  </td>
                  <form id="delete-form-{{$item->dept_grp}}"
                     + action="{{ route('dept_group.destroy', $item->dept_grp)}}" 
                     method="post">
                     @csrf 
                     @method('DELETE')
                  </form>
               </tr>
            @endforeach
            </tbody>
         </table>
      </div>
   </body>
</html>
