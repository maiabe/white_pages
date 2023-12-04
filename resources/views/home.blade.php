@extends('../Layout/layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($announcement)
                @php
                $now = now();
                $isBetweenDates = $now->greaterThanOrEqualTo($announcement->begin_date) && $now->lessThanOrEqualTo($announcement->end_date);
                @endphp
                @if($isBetweenDates)
                    <div class="alert alert-warning" role="alert">
                        <strong>Announcement</strong>
                        <br>
                        {{ $announcement->message }}
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; top: 10px; right: 10px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
               @endif
            @endif
        </div>
    </div>
</div>

@endsection
