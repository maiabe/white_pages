@extends('../Layout/layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($announcement)
            @php
            $now = now();
            $isBetweenDates = $now->greaterThanOrEqualTo($announcement->begin_date) &&
            $now->lessThanOrEqualTo($announcement->end_date);
            @endphp
            @if($isBetweenDates)
            <div class="alert alert-warning mt-3" role="alert">
                <strong>Announcement</strong>
                <br>
                {{ $announcement->message }}
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"
                        style="position: absolute; top: 10px; right: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @endif
        </div>
        <div class="home-container">
            <div class="main">
                <div class="text-center">
                    <img src="/images/logo/WPS.png" alt="UH White Page" class="navbar-logo">
                    <p style="margin-top: -50px; margin-left: 200px; margin-right: 200px; margin-bottom: 100px">The
                        WhitePages Management System is a one-stop web app used to maintain university affiliate records
                        and manage their role privileges.</p>
                </div>

                <div class="row welcome-section">
                    <div class="col-md-6 mx-auto">
                        <img src="/images/logo/Welcome.png" alt="UH White Page" class="navbar-logo img-fluid"
                             style="height: 100%; width: 100%;">
                    </div>
                    <div class="col-md-6 mx-auto">
                        <!--                        <font-awesome-icon icon="user"-->
                        <!--                                           style="height: 20px; width: 20px; color: #0c0c0c;"></font-awesome-icon>-->
                        <p style="font-family: 'Droid Sans Mono'; font-size: 100px; color: #86c2f1 ">
                            {{ Auth::user()->name }}</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
