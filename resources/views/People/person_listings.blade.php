
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
                    </tr>
                    @endforeach
                    </tbody>
                </table>

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


@endsection
