@extends('../Layout/layout')

@section('content')
<div class="container-fluid">
    <div>
        <h1>Manage White Pages Roles</h1>
    </div>    
    
    <div class="table-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <table id="dept-contacts-table" class="table table-size table-bordered mt-5">
                <thead class="table-header-color align-middle">
                    <tr>
                        <th>Contact Name</th>
                        <th>Campus Code</th>
                        <th>Department Name</th>
                        <th>UH Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Edit Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unique_persons as $index => $person)
                        <tr id= {{"trow-". $person -> pid}}>
                            <td>{{$person->name_of_record}}</td>
                            <td>{{$person->code}}</td>
                            <td>{{$person->dept_name}}</td>
                            <td>{{$person->per_email}}</td>
                            <td>{{$person->per_phone}}</td>
                            <td>{{$combined_roles[$index]->roles}}</td>
                            <td style="text-align: center;">
                            <button class="btn edit-button btn-custom"
                                    style="background-color: #86C2F1;"
                                    data-name="{{ $person->name_of_record }}"
                                    data-id="{{$person->pid}}"
                                    data-roles="{{$combined_roles[$index]->roles}}"
                                    data-toggle="modal" data-target="#editPersonModal">
                                <i class="fa fa-pencil"></i>
                            </button>
                            </td>
           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- editPersonModal -->
<div class="modal fade" id="editPersonModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- All named variables in form are passed in request -->
            <form 
                action="{{ route('person_role.update',
                 ':id') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background-color: #86C2F1;">
                    <h5 class="modal-title" 
                        id="editModalLabel">Edit Person's Roles</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" 
                        aria-label="Close" id="edit-x-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="person_label"></h5>
                    <div class="form-group">
                        <input type="checkbox" name="role-Member" 
                            id="role-Member">
                        <label for="role-Member">&nbsp;Member</label><br/>
                        <input type="checkbox" name="role-Primary" id="role-Primary">
                        <label for="role-Primary">&nbsp;Primary</label><br/>
                        <input type="checkbox" name="role-Secondary" id="role-Secondary">
                        <label for="role-Secondary">&nbsp;Secondary</label><br/>
                        <input type="checkbox" name="role-Admin" id="role-Admin">
                        <label for="role-Admin">&nbsp;Admin</label><br/>
                        <input type="checkbox" name="role-HelpDesk" id="role-HelpDesk">
                        <label for="role-HelpDesk">&nbsp;HelpDesk</label><br/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" 
                        data-bs-dismiss="modal" id="edit-close-button">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
   $(document).ready(function () {
        $("#dept-contacts-table").DataTable({
            "pagingType": "simple_numbers",
            "language": {
                "emptyTable": "The Person Listings table is empty",
                "lengthMenu": "Display _MENU_ persons",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "zeroRecords": "No search results found",
                "paginate": {
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
    
        // Function to handle the edit button click
    $(document).ready(function () {
        $("#dept-contacts-table").on("click", ".edit-button", function () {
            let role_data = {};
            let personRoles = $(this).data("roles");
            let personName = $(this).data("name");
            let personId = $(this).data("id");
            const person_label = document.getElementById('person_label');
            person_label.innerHTML = personName;
            const role_tokens = personRoles.split(",");
            const role_checkboxes = document.getElementsByTagName("input");
            for (let checkbox of role_checkboxes) {
               checkbox.checked = false;  //clear checkboxes initially
            }
            for (let checkbox of role_checkboxes) {
               let id_tokens = checkbox.id.split("-");
               console.log(id_tokens[1]);
               if (role_tokens.includes(id_tokens[1])) {
                  console.log('found');
                  checkbox.checked = true;
               }
            }

            $("#editPersonModal").modal("show");

            var editUrl = "{{ route('person_role.update', ':id') }}";
            editUrl = editUrl.replace(":id", personId);
            $("#editPersonModal form").attr("action", editUrl);
        });
     });

    
</script>
@endsection