
<template>
    <form action="{{ route('dept_groups.update', ':deptGrp' ) }}" method="POST">
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
                    <!-- @foreach($campusData as $item)
                    <option value="{{$item}}">{{$item}}</option>
                    @endforeach -->
                </select>
            </div>
    </form>
</template>

<script>
    
</script>