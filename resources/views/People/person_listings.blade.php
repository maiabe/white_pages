
@extends('../Layout/layout')

@section('content')
    <div class="container">
        <div>
            <h1>Person Listings</h1>
        </div>
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
    @if(count($data)>0)
    <table id="table" class="table table-bordered table-hovered">
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
            @foreach($data as $item)
            <tr>
                <td>{{$item->username}}</td>
                <td>{{$item->name }}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->location}}</td>
                <td>{{$item->fax}}</td>
                <td>{{$item->website}}</td>
                <td>{{$item->publishable  ? 'True' : 'False' }}</td>
                <td style="text-align: center;">
                    <button class="btn edit-button btn-custom"
                            style="background-color: #86C2F1;"
                            data-username="{{ $item->username }}"
                            data-name="{{ $item->name }}"
                            data-email="{{ $item->email }}"
                            data-phone="{{ $item->phone }}"
                            data-location="{{ $item->location }}"
                            data-fax="{{ $item->fax }}"
                            data-website="{{ $item->website }}"
                            data-publishable="{{ $item->publishable  ? 'True' : 'False' }}"
                            data-toggle="modal" data-target="#editPersonModal">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>
                <td style="text-align: center;">
                    <button class="btn delete-button btn-custom"
                            style="background-color: #CB5D5D;"
                            data-username="{{ $item->username }}"
                            data-name="{{ $item->name }}"
                            data-email="{{ $item->email }}"
                            data-phone="{{ $item->phone }}"
                            data-location="{{ $item->location }}"
                            data-fax="{{ $item->fax }}"
                            data-website="{{ $item->website }}"
                            data-publishable="{{ $item->publishable  ? 'True' : 'False' }}"
                            data-toggle="modal" data-target="#deletePersonModal">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                    <b>Email</b>: <span id="delete-person-email"></span><br>
                    <b>Phone</b>: <span id="delete-person-phone"></span><br>
                    <b>Location</b>: <span id="delete-person-location"></span><br>
                    <b>Fax</b>: <span id="delete-person-fax"></span><br>
                    <b>Website</b>: <span id="delete-person-website"></span><br>
                    <b>Publishable</b>: <span id="delete-person-publishable"></span><br>
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
                                   required minlength="10" maxlength="60" title="Enter a username (6 to 60 characters)">
                        </div>
                        <div class="form-group">
                            <label for="edit-person-email">Email</label>
                            <input type="text" name="email" class="form-control" id="edit-person-email"
                                   required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address (e.g., example@hawaii.due)">
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
    @endif
    </div>

<script>
    $(document).ready(function () {
    $("#table").DataTable({
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
    $("#table").on("click", ".edit-button", function () {
        var personUsername = $(this).data("username");
        var personName = $(this).data("name");
        var personEmail = $(this).data("email");
        var personPhone = $(this).data("phone");
        var personLocation = $(this).data("location");
        var personFax = $(this).data("fax");
        var personWebsite = $(this).data("website");
        var personPub = $(this).data("publishable");

        $("#edit-username").val(personUsername);
        $("#edit-person-name").val(personName);
        $("#edit-person-email").val(personEmail);
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
    $("#table").on("click", ".delete-button", function () {
        var personUsername = $(this).data("username");
        var personName = $(this).data("name");
        var personEmail = $(this).data("email");
        var personPhone = $(this).data("phone");
        var personLocation = $(this).data("location");
        var personFax = $(this).data("fax");
        var personWebsite = $(this).data("website");
        var personPub = $(this).data("publishable");

        $("#delete-username").text(personUsername);
        $("#delete-person-name").text(personName);
        $("#delete-person-email").text(personEmail);
        $("#delete-person-phone").text(personPhone);
        $("#delete-person-location").text(personLocation);
        $("#delete-person-fax").text(personFax);
        $("#delete-person-website").text(personWebsite);
        $("#delete-person-publishable").text(personPub);

        $("#deletePersonModal").modal("show");


        var deleteUrl = "{{ route('person_listings.destroy', ':personUsername') }}";
        deleteUrl = deleteUrl.replace(":personUsername", personUsername);
        $("#delete-form").attr("action", deleteUrl);

        // Rest of the code remains the same
    });
});
</script>
@endsection
