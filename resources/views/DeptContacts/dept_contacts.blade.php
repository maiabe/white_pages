
@extends('../Layout/layout')

@section('content')

    <div class="main-container">
        <h1>Manage Department Contacts</h1>
        @if ($errors->any())
            <h6 class="alert alert-danger mt-4">
                <strong>Department Contact change failed</strong>
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
            <button id="dept-contact-add-button-0" type="button" class="add-button mt-4" data-bs-toggle="modal" data-bs-target="#dept-contact-add-modal-0">
                Add Department Contact
            </button>
            <modal-component
                :modal-id="'dept-contact-add-modal-0'"
                :index="0"
                :modal-type="'dept-contact-add'"
                :modal-title="'Add Department Contact'"
                :modal-content="'AddComponent'"
                :entry="{{ $data }}"
                :action-route="'{{ route('dept_contacts.store') }}'"
            >
                <add-component
                    :action-route="'{{ route('dept_contacts.store') }}'"
                />
                
            </modal-component>
        </div>

        @if(count($data)>0)
            <div class="main-wrapper">
                
                <table-component
                    :table-name="'Department Contact'"
                    :table-id="'dept-contacts-table'"
                    :table-entries="{{ $data }}"
                    :edit-action-route="'{{ route('dept_contacts.update') }}'"
                    :delete-action-route="'{{ route('dept_contacts.destroy') }}'"
                />

            </div>

        @else
            <br>
            <div class="alert alert-info mt-5" role="alert">
                No Department Groups to display.
            </div>
        @endif
        

    </div>
@endsection