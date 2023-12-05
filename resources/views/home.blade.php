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
                    <div class="alert alert-warning mt-3" role="alert">
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
        <div class="main">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h2 class="text-center">White Pages Management System </h2>
                    <p class="text-center">This is a brief description of the website. You can add any relevant information or text here.</p>
                </div>
                <div class="col-md-6 mx-auto">
                    <img src="/images/logo/WPS.png" alt="UH White Page" class="navbar-logo img-fluid">
                </div>
            </div>
            <div class="row section-2">
                <div class="col-md-6 ">
                    <div class="user-welcome text-center">
                        <div class="user-icon-container">
                            <font-awesome-icon icon="user" style="height: 100px; width: 100px; color: #0c0c0c;"></font-awesome-icon>
                        </div>
                        <div class="welcome-text">
                            <h2>Welcome</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
