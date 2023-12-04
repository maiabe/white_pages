@extends('../Layout/layout')

@section('content')

<div class="container mx-auto">
    <h2 class="text-center">Announcement</h2>
    <p class="text-center h5">Instructions:</p>
    <ul class="list-unstyled text-center">
        <li class="mb-2">Enter a Message that will appear on the Home Page for all Users.</li>
        <li class="mb-2">Please limit your message to 200 characters.</li>
    </ul>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('save-announcement') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="announcementMessage" class="form-label">Message:</label>
                    <input type="text" class="form-control" id="announcementMessage" name="announcementMessage" maxlength="200" required>
                </div>

                <div class="mb-3">
                    <label for="beginDate" class="form-label">Begin Date:</label>
                    <input type="date" class="form-control" id="beginDate" name="beginDate" required>
                </div>

                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date:</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Set Announcement</button>
            </form>
        </div>
    </div>

    <hr>
    <p class="text-center">
        Below is the information for the announcement.<b> It will be visible starting from the "Start Date" and will be hidden after the "End Date.</b>"
    </p>
    <div class="row justify-content-center">
        @if($announcement)
        <div class="card mb-2">
            <div class="card-header h2 text-center">Announcement</div>
            <div class="card-body">
                <strong>Message</strong>: {{ $announcement->message}}
                <hr>
                <strong>Start Date</strong>: {{ $announcement->begin_date}}
                <hr>
                <strong>End Date</strong>: {{ $announcement->end_date}}
            </div>
            <div class="card-footer text-muted text-center">
                Posted on {{ $announcement->created_at->format('Y-m-d H:i:s') }}
            </div>
        </div>
        @endif
    </div>
    <p class="text-center mt-4">
        To modify the information, edit it with new details and click the "Set Announcement" blue button.
    </p>
</div>

@endsection
