<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head>
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script
        src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 6px 12px;
            margin-right: 5px;
            border: 1px solid #007bff;
            background-color: #fff;
            color: #007bff;
            border-radius: 4px;
            cursor: pointer;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff;
            color: #fff;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "pagingType": "simple_numbers",
                "language": {
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div id="header"></div>
</br>
<div class="container">
    <div id="sidebar"></div>
    </br>
    <table id="table" class="table table-hover">
        <thead>
        <th>Campus Code</th>
        <th>Group Number</th>
        <th>Department Group Name</th>
        <th>Delete</th>
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
                    <button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
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
</br>
<div id="footer"></div>
</body>
=======
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
>>>>>>> upstream/main
</html>
