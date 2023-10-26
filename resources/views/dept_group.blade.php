<!DOCTYPE html>
<html>
<head>
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
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

        .dataTables_wrapper .dataTables_paginate .paginate_button.active {
            background-color: #b0cbe8;
            color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
        }

        .form-group {
            margin-bottom: 20px; /* You can adjust the value to control the amount of space */
        }
    </style>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div id="header"></div>
<br>
<div class="container">
    <h1 style="text-align: center" ;>Manage Department Groupings</h1>
    <div id="sidebar"></div>
    <br>
    @if(count($data)>0)
    @if ($errors->any())
    <h6 class="alert alert-danger">
        The Department Grouping was not updated successfully<br>
        @foreach ($errors->all() as $error)
        &#9888; {{ $error }}<br>
        @endforeach
        Please revise and resubmit to update record!
    </h6>
    @endif
    <button id="add-button" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#addDeptGrpModal">
        Add Department Group
    </button>
    <table id="table" class="table table-hover">
        <thead>
        <th>Campus Code</th>
        <th>Group Number</th>
        <th>Department Group Name</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{$item->campus_code}}</td>
            <td>{{$item->dept_grp}}</td>
            <td>{{$item->dept_grp_name}}</td>
            <td>
                <button class="btn btn-primary edit-button"
                        data-dept-grp="{{ $item->dept_grp }}"
                        data-dept-grp-name="{{ $item->dept_grp_name }}"
                        data-campus-code="{{ $item->campus_code }}"
                        data-toggle="modal" data-target="#editModal">
                    <i class="fa fa-pencil"></i>
                </button>
            </td>
            <td>
                <button class="btn btn-danger delete-button"
                        data-dept-grp="{{ $item->dept_grp }}"
                        data-dept-grp-name="{{ $item->dept_grp_name }}"
                        data-campus-code="{{ $item->campus_code }}"
                        data-toggle="modal" data-target="#deleteModal">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #f14a59;">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Department Group</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deleting this department group will completely remove the record from the database
                    <br><br>
                    <b>Group Number</b>: <span id="delete-dept-grp"></span><br>
                    <b>Department Group Name</b>: <span id="delete-dept-grp-name"></span><br>
                    <b>Campus Code</b>: <span id="delete-campus-code"></span><br>
                    <br>
                    Are you sure you want to delete this Department Group?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dept_group.update', ':deptGrp' ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header" style="background-color: #40d8f3;">
                        <h5 class="modal-title" id="editModalLabel">Edit Department Group</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                                id="edit-x-button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                            <label for="edit-dept-grp">Group Number</label>
                            <input type="text" name="dept_grp" class="form-control" id="edit-dept-grp"
                                   required minlength="6" maxlength="6">
                        </div>
                        <div class="form-group">
                            <label for="edit-dept-grp-name">Department Group Name</label>
                            <input type="text" name="dept_grp_name" class="form-control" id="edit-dept-grp-name"
                                   required minlength="3" maxlength="60">
                        </div>
                        <div class="form-group">
                            <label for="edit-dept-grp-name">Campus Code</label>
                            <select name="campus_code" class="form-control" id="edit-campus-code">
                                @foreach($campusData as $item)
                                <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="edit-close-button">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addDeptGrpModal" tabindex="-1" aria-labelledby="addDeptGrpModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeptGrpModalLabel">Add Department Group</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            id="add-x-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a new Department Group -->
                    <form action="{{route('dept_group.store')}}" method="POST" id="addDeptGrpForm">
                        @csrf
                        <div class="form-group">
                            <label for="dept_grp">Group Number</label>
                            <input type="text" class="form-control" id="dept_grp" name="dept_grp" required minlength="6"
                                   maxlength="6">
                        </div>
                        <div class="form-group">
                            <label for="dept_grp_name">Department Group Name</label>
                            <input type="text" class="form-control" id="dept_grp_name" name="dept_grp_name" required
                                   minlength="3" maxlength="60">
                        </div>
                        <div class="form-group">
                            <label for="campus_code">Campus Code</label>
                            <select name="campus_code" class="form-control" id="add-campus-code">
                                @foreach($campusData as $item)
                                <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    id="add-close-button">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info" role="alert">
        No Department Groups to display.
    </div>
    @endif

</div>
<br>
<div id="footer"></div>
<script>
    $(document).ready(function () {
        $("#table").DataTable({
            "pagingType": "simple_numbers",
            "language": {
                "paginate": {
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
        // Function to handle the delete button click
        $("#table").on("click", ".delete-button", function () {
            var deptGrp = $(this).data("dept-grp");
            var deptGrpName = $(this).data("dept-grp-name");
            var campusCode = $(this).data("campus-code");

            $("#delete-dept-grp").text(deptGrp);
            $("#delete-dept-grp-name").text(deptGrpName);
            $("#delete-campus-code").text(campusCode);
            $("#deleteModal").modal("show");

            var deleteUrl = "{{ route('dept_group.destroy', ':deptGrp') }}";
            deleteUrl = deleteUrl.replace(":deptGrp", deptGrp);
            $("#delete-form").attr("action", deleteUrl);
        });

        // Function to handle the delete button click
        $("#table").on("click", ".edit-button", function () {
            var deptGrp = $(this).data("dept-grp");
            var deptGrpName = $(this).data("dept-grp-name");
            var campusCode = $(this).data("campus-code");

            $("#edit-dept-grp").val(deptGrp);
            $("#edit-dept-grp-name").val(deptGrpName);
            $("#edit-campus-code").val(campusCode);
            $("#editModal").modal("show");

            var editUrl = "{{ route('dept_group.update', ':deptGrp') }}";
            editUrl = editUrl.replace(":deptGrp", deptGrp);
            $("#editModal form").attr("action", editUrl);
        });

        // Function to handle the add button click
        $("#add-button").on("click", function () {
            $("#addDeptGrpModal").modal("show");
        });

    });
</script>
</body>
</html>
