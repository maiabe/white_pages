
@extends('../Layout/layout')

@section('content')
    <div class="container-fluid">
        <div>
            <h1>Person Listings/Pending Person Listings</h1>
        </div>

        <br/>
        @if ($errors->any())
            <h6 class="alert alert-danger mt-4">
                <strong>The Person was not updated successfully</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; top:10px; right: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                @foreach ($errors->all() as $error)
                &#9888; {{ $error }}<br>
                @endforeach
                Please revise and resubmit to update person record!
            </h6>
        @endif
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-person-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Person</button>
                <button class="nav-link" id="nav-pperson-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Pending Person</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                @if(count($personData) > 0)
                <table id="person-listings-table" class="table table-size table-bordered mt-5">
                    <thead class="table-header-color align-middle">
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Name of Record</th>
                        <th>Job Title</th>
                        <th>Email</th>
                        <th>Alias Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Fax</th>
                        <th>Website</th>
                        <th>Publishable</th>
                        <th>Last Approved</th>
                        <th>Approved By</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personData as $item)
                    <tr class="custom-row">
                        <td>{{$item->username}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->name_of_record}}</td>
                        <td>{{$item->job_title}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->alias_email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->location}}</td>
                        <td>{{$item->fax}}</td>
                        <td>{{$item->website}}</td>
                        <td>{{$item->publishable  ? 'True' : 'False' }}</td>
                        <td>{{$item->lastApprovedAt}}</td>
                        <td>{{$item->lastApprovedBy}}</td>
                        <td style="text-align: center;">
                            <button class="btn edit-button btn-custom"
                                    style="background-color: #86C2F1;"
                                    data-username="{{ $item->username }}"
                                    data-name="{{ $item->name }}"
                                    data-name-of-record="{{ $item->name_of_record }}"
                                    data-job-title="{{ $item->job_title }}"
                                    data-email="{{ $item->email }}"
                                    data-alias-email="{{ $item->alias_email }}"
                                    data-phone="{{ $item->phone }}"
                                    data-location="{{ $item->location }}"
                                    data-fax="{{ $item->fax }}"
                                    data-website="{{ $item->website }}"
                                    data-publishable="{{ $item->publishable  ? 'True' : 'False' }}"
                                    data-last-approved-at="{{ $item->lastApprovedAt }}"
                                    data-last-approved-by="{{ $item->lastApprovedBy }}"
                                    data-toggle="modal" data-target="#editPersonModal">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                        <td style="text-align: center;">
                            <button class="btn delete-button btn-custom"
                                    style="background-color: #CB5D5D;"
                                    data-username="{{ $item->username }}"
                                    data-name="{{ $item->name }}"
                                    data-name-of-record="{{ $item->name_of_record }}"
                                    data-job-title="{{ $item->job_title }}"
                                    data-email="{{ $item->email }}"
                                    data-alias-email="{{ $item->alias_email }}"
                                    data-phone="{{ $item->phone }}"
                                    data-location="{{ $item->location }}"
                                    data-fax="{{ $item->fax }}"
                                    data-website="{{ $item->website }}"
                                    data-publishable="{{ $item->publishable  ? 'True' : 'False' }}"
                                    data-last-approved-at="{{ $item->lastApprovedAt }}"
                                    data-last-approved-by="{{ $item->lastApprovedBy }}"
                                    data-toggle="modal" data-target="#deletePersonModal">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <p>No data available for person listings</p>
                @endif
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <table id="pending-persons-table" class="table table-size table-bordered table-responsive mt-5">
                    <thead class="table-header-color align-middle">
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Fax</th>
                    <th>Website</th>
                    <th>Publishable</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>
                    {{-- @foreach($pendingPersonData as $item) --}}
                    <tr class="custom-row">
                        <td>{{$item->username}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->location}}</td>
                        <td>{{$item->fax}}</td>
                        <td>{{$item->website}}</td>
                        <td>{{$item->publishable}}</td>
                    </tr>
                    {{-- @endforeach --}}
                </table>
            </div>
        </div>
    </div>
<!-- Delete Modal -->
<div class="modal fade" id="deletePersonModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#e85757;">
                <h5 class="modal-title" id="deleteModalLabel">Delete Person</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deleting this person will completely remove the record from the database
                <br><br>
                <b>Username</b>: <span id="delete-username"></span><br>
                <b>Name</b>: <span id="delete-person-name"></span><br>
                <b>Name of Record</b>: <span id="delete-person-name-of-record"></span><br>
                <b>Job Title</b>: <span id="delete-person-job-title"></span><br>
                <b>Email</b>: <span id="delete-person-email"></span><br>
                <b>Phone</b>: <span id="delete-person-phone"></span><br>
                <b>Location</b>: <span id="delete-person-location"></span><br>
                <b>Fax</b>: <span id="delete-person-fax"></span><br>
                <b>Website</b>: <span id="delete-person-website"></span><br>
                <b>Publishable</b>: <span id="delete-person-publishable"></span><br>
                <b>Last Approved</b>: <span id="delete-person-last-approved-at"></span><br>
                <b>Approved By</b>: <span id="delete-person-last-approved-by"></span><br>
                <br>
                Are you sure you want to delete this Person?
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
<div class="modal fade" id="editPersonModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('person_listings.update', ':personUsername' ) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background-color: #86C2F1;">
                    <h5 class="modal-title" id="editModalLabel">Edit Person</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            id="edit-x-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-username">Username</label>
                        <input type="text" name="username" class="form-control" id="edit-username"
                               required minlength="6" maxlength="60" title="Enter a username (6 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-name">Name</label>
                        <input type="text" name="name" class="form-control" id="edit-person-name"
                               required minlength="2" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-name-of-record">Name of Record</label>
                        <input type="text" name="name_of_record" class="form-control" id="edit-person-name-of-record"
                               required minlength="0" maxlength="255" title="Enter a name of record (10 to 255 characters)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-job-title">Job Title</label>
                        <input type="text" name="job_title" class="form-control" id="edit-person-job-title"
                               required minlength="10" maxlength="60" title="Enter a job title (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-email">Email</label>
                        <input type="text" name="email" class="form-control" id="edit-person-email"
                               required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address (e.g., example@hawaii.due)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-alias-email">Alias Email</label>
                        <input type="text" name="alias_email" class="form-control" id="edit-person-alias-email"
                               required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" maxlength="100" title="Enter a alias email (10 to 100 characters)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="edit-person-phone"
                               required pattern="^\d{3}-\d{3}-\d{4}$" title="Enter a phone number in the format xxx-xxx-xxxx (e.g., 123-456-7890)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-location">Location</label>
                        <input type="text" name="location" class="form-control" id="edit-person-location"
                               required minlength="0" maxlength="100"  title="Enter a location (up to 100 characters)">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-fax">Fax</label>
                        <input type="text" name="fax" class="form-control" id="edit-person-fax"
                               required pattern="^\+?[0-9]+(\s?[-.]?\s?[0-9]+)*$"
                               title="Enter a correct fax format, e.g., +1 8083456789">
                    </div>
                    <div class="form-group">
                        <label for="edit-person-website">Website</label>
                        <input type="text" name="website" class="form-control" id="edit-person-website"
                               required pattern="/(https:\/\/www\.|http:\/\/www\.|https:\/\/|http:\/\/)?[a-zA-Z]{2,}(\.[a-zA-Z]{2,})(\.[a-zA-Z]{2,})?\/[a-zA-Z0-9]{2,}|((https:\/\/www\.|http:\/\/www\.|https:\/\/|http:\/\/)?[a-zA-Z]{2,}(\.[a-zA-Z]{2,})(\.[a-zA-Z]{2,})?)|(https:\/\/www\.|http:\/\/www\.|https:\/\/|http:\/\/)?[a-zA-Z0-9]{2,}\.[a-zA-Z0-9]{2,}\.[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,})?/g;"
                               title="Enter a valid website URL (e.g., http://example.com)">
                    </div>

                    <div class="form-group">
                        <label for="edit-person-publishable">Publishable</label>
                        <select name="publishable" class="form-control" id="edit-person-publishable">
                            <option value="true">True</option>
                            <option value="false">False</option>
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
<div class="modal fade" id="addPersonModal" tabindex="-1" aria-labelledby="addPersonModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPersonModalLabel">Add New Person</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        id="add-x-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new Department Group -->
                <form action="{{route('person_listings.store')}}" method="POST" id="addPersonForm">
                    @csrf
                    <div class="form-group">
                        <label for="add-username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               required minlength="2" maxlength="60" title="Enter a username (6 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-name-of-record">Name of Record</label>
                        <input type="text" class="form-control" id="name_of_record" name="name_of_record"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-job-title">Job Title</label>
                        <input type="text" class="form-control" id="job_title" name="job_title"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-alias-email">Alias Email</label>
                        <input type="text" class="form-control" id="alias_email" name="alias_email"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               required pattern="^\d{3}-\d{3}-\d{4}$" title="Enter a phone number in the format xxx-xxx-xxxx (e.g., 123-456-7890)">
                    </div>
                    <div class="form-group">
                        <label for="add-location">Location</label>
                        <input type="text" class="form-control" id="location" name="location"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-fax">Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax"
                               required pattern="^\+?[0-9]+(\s?[-.]?\s?[0-9]+)*$" title="Enter a correct fax format, e.g., +1 8083456789">
                    </div>
                    <div class="form-group">
                        <label for="add-website">Website</label>
                        <input type="text" class="form-control" id="website" name="website"
                               required minlength="3" maxlength="60" title="Enter a name (10 to 60 characters)">
                    </div>
                    <div class="form-group">
                        <label for="add-publishable">Publishable</label>
                        <select name="publishable" class="form-control" id="publishable">
                            <option value="true">True</option>
                            <option value="false">False</option>
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
</div>

<script>
    $(document).ready(function () {
        $("#person-listings-table").DataTable({
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

        // Function to handle the edit button click
        $("#person-listings-table").on("click", ".edit-button", function () {
            var personUsername = $(this).data("username");
            var personName = $(this).data("name");
            var personNameOfRecord = $(this).data("nameOfRecord");
            var personJobTitle = $(this).data("jobTitle");
            var personEmail = $(this).data("email");
            var personAliasEmail = $(this).data("aliasEmail");
            var personPhone = $(this).data("phone");
            var personLocation = $(this).data("location");
            var personFax = $(this).data("fax");
            var personWebsite = $(this).data("website");
            var personPub = $(this).data("publishable");

            $("#edit-username").val(personUsername);
            $("#edit-person-name").val(personName);
            $("#edit-person-name-of-record").val(personNameOfRecord);
            $("#edit-person-job-title").val(personJobTitle);
            $("#edit-person-email").val(personEmail);
            $("#edit-person-alias-email").val(personAliasEmail);
            $("#edit-person-phone").val(personPhone);
            $("#edit-person-location").val(personLocation);
            $("#edit-person-fax").val(personFax);
            $("#edit-person-website").val(personWebsite);
            $("#edit-person-publishable option").filter(function() {
                return $(this).text() === personPub;
            }).prop('selected', true);

            $("#editPersonModal").modal("show");

            var editUrl = "{{ route('person_listings.update', ':personUsername') }}";
            editUrl = editUrl.replace(":personUsername", personUsername);
            $("#editPersonModal form").attr("action", editUrl);
        });

        // Function to handle the delete button click
        $("#person-listings-table").on("click", ".delete-button", function () {
            var personUsername = $(this).data("username");
            var personName = $(this).data("name");
            var personNameOfRecord = $(this).data("nameOfRecord");
            var personJobTitle = $(this).data("jobTitle");
            var personEmail = $(this).data("email");
            var personAliasEmail = $(this).data("aliasEmail");
            var personPhone = $(this).data("phone");
            var personLocation = $(this).data("location");
            var personFax = $(this).data("fax");
            var personWebsite = $(this).data("website");
            var personPub = $(this).data("publishable");
            var personLastApprovedAt = $(this).data("lastApprovedAt");
            var personLastApprovedBy = $(this).data("lastApprovedBy");

            $("#delete-username").text(personUsername);
            $("#delete-person-name").text(personName);
            $("#delete-person-name-of-record").text(personNameOfRecord);
            $("#delete-person-job-title").text(personJobTitle);
            $("#delete-person-email").text(personEmail);
            $("#delete-person-alias-email").text(personAliasEmail);
            $("#delete-person-phone").text(personPhone);
            $("#delete-person-location").text(personLocation);
            $("#delete-person-fax").text(personFax);
            $("#delete-person-website").text(personWebsite);
            $("#delete-person-publishable").text(personPub);
            $("#delete-person-last-approved-at").text(personLastApprovedAt);
            $("#delete-person-last-approved-by").text(personLastApprovedBy);

            $("#deletePersonModal").modal("show");

            var deleteUrl = "{{ route('person_listings.destroy', ':personUsername') }}";
            deleteUrl = deleteUrl.replace(":personUsername", personUsername);
            $("#delete-form").attr("action", deleteUrl);
        });

        // Function to handle the add button click
        $("#add-button").on("click", function () {
            $("#addPersonModal").modal("show");
        });
    });

    $(document).ready(function () {
        $("#pending-persons-table").DataTable({
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
</script>


@endsection
