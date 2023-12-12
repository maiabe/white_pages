
@extends('../Layout/layout')


@section('content')

    <div class="main-title-container">
        <div class="main-title-wrapper">
            <h1>WPMS Admins</h1>
        </div>
    </div>
    <div class="main-container">
        @if ($errors->any())
            <h6 class="alert alert-danger mt-4">
                <strong>Admin record change failed</strong>
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
        

        @if(count($data)>0)
            <div class="main-wrapper">
                
                <table-component
                    :table-name="'Admins'"
                    :table-id="'admins-table'"
                    :table-entries="{{ $data }}"
                />

            </div>

        @else
            <br>
            <div class="alert alert-info mt-5" role="alert">
                No Admins to display.
            </div>
        @endif
        

    </div>

@endsection

