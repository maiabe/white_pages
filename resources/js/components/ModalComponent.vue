<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" :aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="modalLabel">{{ modalTitle }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            id="x-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- <form action="{{ route('dept_groups.update', ':deptGrp' ) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="edit-dept-grp">Group Number</label>
                                <input type="text" name="dept_grp" class="form-control" id="edit-dept-grp"
                                    required minlength="6" maxlength="6" pattern="[0-9]{6}" title="exactly 6 digits (0-9)">
                            </div>
                            <div class="form-group">
                                <label for="edit-dept-grp-name">Department Group Name</label>
                                <input type="text" name="dept_grp_name" class="form-control" id="edit-dept-grp-name"
                                    required minlength="3" maxlength="60">
                            </div>
                            <div class="form-group">
                                <label for="edit-dept-grp-name">Campus Code</label>
                                <select name="campus_code" class="form-control" id="edit-campus-code">
                                    @foreach($campusData as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </form> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-button">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'ModalComponent',
        props: ['modalId', 'modalLabel', 'modalTitle']
    }
</script>