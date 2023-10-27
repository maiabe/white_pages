

<script>
    $(document).ready(function () {
        $("#table").DataTable({
            "pagingType": "simple_numbers",
            "language": {
                "emptyTable": "The Department Groups table is empty",
                "lengthMenu": "Display _MENU_ groups",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "zeroRecords": "No search results found",
                "paginate": {
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            // Has table length, table info, and pagination in same row
            //"dom": "<'row'<'col-sm-12'tr>><'row'<'col-sm-5'l><'col-sm-3'i><'col-sm-4'p>>",
            // Moves "Show <10> entries" to bottom of table
            // "dom": "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-4'li><'col-sm-8'p>>",
            // info: false,
            label: false
        });
        // Function to handle the delete button click
        $("#table").on("click", ".delete-button", function () {
            var deptGrp = $(this).data("dept-grp");
            var deptGrpName = $(this).data("dept-grp-name");
            var campusCode = $(this).data("campus-code");

            $("#delete-dept-grp").text(deptGrp);
            $("#delete-dept-grp-name").text(deptGrpName);
            $("#delete-campus-code").text(campusCode);
            $("#deleteModal").modal("show");

            var deleteUrl = "{{ route('dept_group.destroy', ':deptGrp') }}";
            deleteUrl = deleteUrl.replace(":deptGrp", deptGrp);
            $("#delete-form").attr("action", deleteUrl);
        });

        // Function to handle the delete button click
        $("#table").on("click", ".edit-button", function () {
            var deptGrp = $(this).data("dept-grp");
            var deptGrpName = $(this).data("dept-grp-name");
            var campusCode = $(this).data("campus-code");

            $("#edit-dept-grp").val(deptGrp);
            $("#edit-dept-grp-name").val(deptGrpName);
            $("#edit-campus-code").val(campusCode);
            $("#editModal").modal("show");

            var editUrl = "{{ route('dept_group.update', ':deptGrp') }}";
            editUrl = editUrl.replace(":deptGrp", deptGrp);
            $("#editModal form").attr("action", editUrl);
        });

        // Function to handle the add button click
        $("#add-button").on("click", function () {
            $("#addDeptGrpModal").modal("show");
        });

    });
</script>
