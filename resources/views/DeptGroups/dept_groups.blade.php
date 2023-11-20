
@extends('../Layout/layout')

@section('content')

    <div class="container">
        <h1>Department Groups</h1>
        <!-- @if ($errors->any())
            <h6 class="alert alert-danger mt-4">
                <strong>The Department Grouping was not updated successfully</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; top:10px; right: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                @foreach ($errors->all() as $error)
                &#9888; {{ $error }}<br>
                @endforeach
                Please revise and resubmit to update record!
            </h6>
        @endif -->
        
        <button id="deptgrp-add-button" type="button" class="add-department-group mt-4" data-bs-toggle="modal" data-bs-target="#addDeptGrpModal">
            Add Department Group
        </button>

        <br/>
        @if(count($data)>0)
            
            <div class="table-wrapper">
                <table-component
                    :table-name="'Department Group'"
                    :table-id="'dept-groups-table'"
                    :table-entries="{{ $data }}"
                    :routeName="'dept_groups'"
                ></table-component>
            </div>

        @else
            <br>
            <div class="alert alert-info mt-5" role="alert">
                No Department Groups to display.
            </div>
        @endif
        

    </div>

@endsection
