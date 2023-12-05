@extends('../Layout/layout')

@section('content')

    <div class="container">
        <h1>Department Listings</h1>
        <!-- @if ($errors->any())
        <h6 class="alert alert-danger mt-4">
            <strong>The Department Grouping was not updated successfully</strong>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; top:10px; right: 10px;">
                <span aria-hidden="true">&times;</span>
            </button>
            <br>
            @foreach ($errors->all() as $error)
            &#9888; {{ $error }}<br>
            @endforeach
            Please revise and resubmit to update record!
        </h6>
        @endif -->


        <div class="add-button-wrapper">
            <button id="add-button" type="button" class="add-button mt-4" data-bs-toggle="modal" data-bs-target="#addDeptModal">
                Add Department
            </button>
        </div>

        <div class="table-wrapper">
            <table-component
                :table-name="'Department Listing'"
                :table-id="'dept-listings-table'"
                :table-entries="{{ json_encode($tableEntries) }}"
            ></table-component>
        </div>



        <br/>
        <!-- @foreach($columns as $column)
            <span>{{$column}}</span>
        @endforeach -->
        <!--@if(count($tableEntries)>0)-->
            <!-- <table id="table" class="table table-bordered table-hover">
                <thead class="table-header-color align-middle">
                <th>Campus Code</th>
                <th>Group Number</th>
                <th>Department Group Name</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($tableEntries as $item)
                        <tr class="align-middle">
                            <td>{{$item->campus_code}}</td>
                            <td>{{$item->dept_grp}}</td>
                            <td>{{$item->dept_grp_name}}</td>
                            <td style="text-align: center;">
                                <button class="btn edit-button btn-custom"
                                        style="background-color: #86C2F1;"
                                        data-dept-grp="{{ $item->dept_grp }}"
                                        data-dept-grp-name="{{ $item->dept_grp_name }}"
                                        data-campus-code="{{ $item->campus_code }}"
                                        data-toggle="modal" data-target="#editModal">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn delete-button btn-custom"
                                        style="background-color: #CB5D5D;"
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
            </table> -->

            <!-- Delete Modal -->
            <!-- <div class="modal fade" id="deleteModal" tabindex="-1" ="dialog" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#e85757;">
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
            </div> -->
            <!-- Edit Modal -->
            <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('dept_groups.update', ':deptGrp' ) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header" style="background-color: #86C2F1;">
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
                                        required minlength="6" maxlength="6" pattern="[0-9]{6}" title="exactly 6 digits (0-9)">
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
            </div> -->
        <!-- @else
            <br>
            <div class="alert alert-info mt-5" role="alert">
                No Department Groups to display.
            </div>
        @endif -->

        <!-- Add Modal -->
        <div class="modal fade" id="addDeptModal" tabindex="-1" aria-labelledby="addDeptGrpModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDeptGrpModalLabel">Add Department</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                                id="add-x-button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a new Department Group -->
                        <!-- <form action="{{route('dept_groups.store')}}" method="POST" id="addDeptGrpForm">
                            @csrf
                            <div class="form-group">
                                <label for="dept_grp">Group Number</label>
                                <input type="text" class="form-control" id="dept_grp" name="dept_grp" required minlength="6"
                                    maxlength="6" pattern="[0-9]{6}" title="exactly 6 digits (0-9)">
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
                        </form> -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <script>
        $(document).ready(function () {
            $("#table").DataTable({
                "pagingType": "simple_numbers",
                "language": {
                    "emptyTable": "The Department Groups table is empty",
                    "lengthMenu": "Display _MENU_ groups",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "zeroRecords": "No search results found",
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                label: false
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

                var deleteUrl = "{{ route('dept_groups.destroy', ':deptGrp') }}";
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

                var editUrl = "{{ route('dept_groups.update', ':deptGrp') }}";
                editUrl = editUrl.replace(":deptGrp", deptGrp);
                $("#editModal form").attr("action", editUrl);
            });

            // Function to handle the add button click
            $("#add-button").on("click", function () {
                $("#addDeptGrpModal").modal("show");
            });

        });
    </script> -->
@endsection
