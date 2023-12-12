
@extends('../Layout/layout')

@section('content')

    <div class="main-title-container">
        <div class="main-title-wrapper">
            <h1>Department Groups</h1>
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
                <strong>Department Group change failed</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; top:10px; right: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                @foreach ($errors->all() as $error)
                &#9888; {{ $error }}<br>
                @endforeach
                Please revise and resubmit to update record!
            </h6>
        @endif

        <div class="add-button-wrapper">
            <button id="deptgrp-add-button-0" type="button" class="add-button mt-4" data-bs-toggle="modal" data-bs-target="#deptgrp-add-modal-0">
                Add Department Group
            </button>
            <modal-component
                :modal-id="'deptgrp-add-modal-0'"
                :index="0"
                :modal-type="'deptgrp-add'"
                :modal-title="'Add Department Group'"
                :modal-content="'AddComponent'"
                :entry="{{ $deptData }}"
                :action-route="'{{ route('dept_groups.store') }}'"
            >
                <add-component
                    :action-route="'{{ route('dept_groups.store') }}'"
                />

            </modal-component>
        </div>

        <div class="nav nav-pills nav-tabs" id="dept-nav-tab-wrapper" role="tablist" >
            <button class="nav-link active" id="dept-nav-tab-tab" data-bs-toggle="tab" data-bs-target="#dept-tab-pane" type="button" role="tab" aria-controls="dept-nav-control" aria-selected="true">
                Departments
            </button>
            <button class="nav-link" id="pending-dept-nav-tab" data-bs-toggle="tab" data-bs-target="#pending-dept-tab-pane" type="button" role="tab" aria-controls="pending-dept-nav-control" aria-selected="false">
                Pending Departments
                <span id="pending-count" class="pending-count badge bg-secondary" style="border-radius: 50%; background-color: #535353;">
                    {{ count($pendingDeptData) }}
                </span>
            </button>
        </div>

        <div class="tab-content" id="dept-tab-content" >
            <div class="tab-pane fade show active" id="dept-tab-pane" role="tabpanel" aria-labelledby="dept-nav-control" tabindex="0">

                @if(count($deptData)>0)
                <div class="main-wrapper">

                    <table-component
                        :table-name="'Department Group'"
                        :table-id="'deptgrps-table'"
                        :table-entries="{{ $deptData }}"
                        :edit-action-route="'{{ route('dept_groups.update') }}'"
                        :delete-action-route="'{{ route('dept_groups.destroy') }}'"
                    />

                </div>

                @else
                    <br>
                    <div class="alert alert-info mt-5" role="alert">
                        No Department Groups to display.
                    </div>
                @endif
            </div>
        </div>

        <div class="tab-content" id="pending-dept-tab-content" >
            <div class="tab-pane fade show" id="pending-dept-tab-pane" role="tabpanel" aria-labelledby="pending-dept-nav-control" tabindex="1">
                @if(count($pendingDeptData)>0)
                    <div class="main-wrapper">

                        <table-component
                            :table-name="'Pending Department Group'"
                            :table-id="'pending-deptgrps-table'"
                            :table-entries="{{ $pendingDeptData }}"
                            :approve-action-route="'{{ route('dept_groups.approve') }}'"
                        />

                    </div>

                @else
                    <br>
                    <div class="alert alert-info mt-5" role="alert">
                        No Pending Department Groups to display.
                    </div>
                @endif
            </div>
        </div>

        


    </div>

@endsection
