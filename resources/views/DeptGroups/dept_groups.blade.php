@extends('../Layout/layout')

@section('content')

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
        Try to re-updated!
    </h6>
    @endif
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeptGrpModal">
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
                <form action="{{ route('dept_groups.update', ':deptGrp' ) }}" method="POST">
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
    @else
    <div class="alert alert-info" role="alert">
        No items to display.
    </div>
    @endif

</div>
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
        $(".delete-button").on("click", function () {
            var deptGrp = $(this).data("dept-grp");
            var deptGrpName = $(this).data("dept-grp-name");
            var campusCode = $(this).data("campus-code");

            $("#delete-dept-grp").text(deptGrp);
            $("#delete-dept-grp-name").text(deptGrpName);
            $("#delete-campus-code").text(campusCode);
            $("#deleteModal").modal("show");

            // Update the form action with the correct URL
            var deleteUrl = "{{ route('dept_groups.destroy', ':deptGrp') }}";
            deleteUrl = deleteUrl.replace(":deptGrp", deptGrp);
            $("#delete-form").attr("action", deleteUrl);
        });
        // Function to handle the delete button click
        $(".edit-button").on("click", function () {
            var deptGrp = $(this).data("dept-grp");
            var deptGrpName = $(this).data("dept-grp-name");
            var campusCode = $(this).data("campus-code");

            $("#edit-dept-grp").val(deptGrp);
            $("#edit-dept-grp-name").val(deptGrpName);
            $("#edit-campus-code").val(campusCode);
            $("#editModal").modal("show");

            // Update the form action with the correct URL
            var editUrl = "{{ route('dept_groups.update', ':deptGrp') }}";
            editUrl = editUrl.replace(":deptGrp", deptGrp);
            $("#editModal form").attr("action", editUrl);
        });

    });
</script>
@endsection

