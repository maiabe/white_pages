
@extends('../Layout/layout')

@section('content')

    <div class="main-title-container">
        <div class="main-title-wrapper">
            <h1>Person Listings</h1>
        </div>
    </div>

    <div class="main-container">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right" >
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="message-wrapper">
                    <span><strong>{{ session('success')['title'] }}</strong></span>
                    <br>
                    <span>{{ session('success')['content'] }}</span>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right" >
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="message-wrapper">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            </div>
        @endif
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


        <div class="add-button-wrapper">
            <button id="person-add-button-0" type="button" class="add-button mt-4" data-bs-toggle="modal" data-bs-target="#person-add-modal-0">
                Add Person Listing
            </button>
            <modal-component
                :modal-id="'person-add-modal-0'"
                :index="0"
                :modal-type="'person-add'"
                :modal-title="'Add Person Listing'"
                :modal-content="'AddComponent'"
                :entry="{{ $peopleData }}"
                :action-route="'{{ route('person_listings.store') }}'"
            >
                <add-component
                    :action-route="'{{ route('person_listings.store') }}'"
                />

            </modal-component>
        </div>


        <div class="nav nav-pills nav-tabs" id="person-nav-tab-wrapper" role="tablist" >
            <button class="nav-link active" id="person-nav-tab-tab" data-bs-toggle="tab" data-bs-target="#person-tab-pane" type="button" role="tab" aria-controls="person-nav-control" aria-selected="true">
                People
            </button>
            <button class="nav-link" id="pending-dept-nav-tab" data-bs-toggle="tab" data-bs-target="#pending-person-tab-pane" type="button" role="tab" aria-controls="pending-person-nav-control" aria-selected="false">
                Pending People
                <span id="pending-count" class="pending-count badge bg-secondary" style="border-radius: 50%; background-color: #535353;">
                    {{ count($pendingPeopleData) }}
                </span>
            </button>
        </div>

        <div class="tab-content" id="person-tab-content" >
            <div class="tab-pane fade show active" id="person-tab-pane" role="tabpanel" aria-labelledby="person-nav-control" tabindex="0">

                @if(count($peopleData)>0)
                    <div class="main-wrapper">

                        <table-component
                            :table-name="'Person Listing'"
                            :table-id="'person-lisings-table'"
                            :table-entries="{{ $peopleData }}"
                            :edit-action-route="'{{ route('person_listings.update') }}'"
                            :delete-action-route="'{{ route('person_listings.destroy') }}'"
                        />

                    </div>

                @else
                    <br>
                    <div class="alert alert-info mt-5" role="alert">
                        No Person Listing to display.
                    </div>
                @endif
            </div>
        </div>

        <div class="tab-content" id="pending-person-tab-content" >
            <div class="tab-pane fade show" id="pending-person-tab-pane" role="tabpanel" aria-labelledby="pending-person-nav-control" tabindex="1">
                @if(count($pendingPeopleData)>0)
                    <div class="main-wrapper">

                        <table-component
                            :table-name="'Pending Person Listing'"
                            :table-id="'pending-person-table'"
                            :table-entries="{{ $pendingPeopleData }}"
                            :approve-action-route="'{{ route('person_listings.approve') }}'"
                        />

                    </div>

                @else
                    <br>
                    <div class="alert alert-info mt-5" role="alert">
                        No Pending Person Listing to display.
                    </div>
                @endif
            </div>
        </div>

        



        
    </div>


@endsection
