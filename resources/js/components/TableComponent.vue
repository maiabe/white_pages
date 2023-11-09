<template>
    <table ref="table" :id="tableId" class="table table-bordered table-hover">
        
        <thead class="table-header-color align-middle">
            <th v-for="column in Object.keys(tableEntries[0])" >
                {{ column }}
            </th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <tr v-for="entry in tableEntries"  class="align-middle">
                <td v-for="value in Object.values(entry)">
                    {{ value }}
                </td>
                <td>
                    <button class="btn edit-button btn-custom">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                </td>
                <td>
                    <button class="btn delete-button btn-custom">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                </td>
            </tr>
        
        </tbody>

    </table>
</template>

<script>

    export default {
        props: {
            tableId: {
                type: String,
                required: true,
            },
            tableColumns: {  
                type: Array
            },
            tableEntries: {  
                type: Array
            }
        },
        mounted() {
            // Dynamically load jQuery and DataTables from CDNs
            this.loadScript('//code.jquery.com/jquery-1.12.3.js', () => {
                this.loadScript('//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js', () => {
                    this.loadScript('https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js', () => {
                        this.initializeDataTable();
                    });
                });
            });
            /* this.$nextTick(() => {
                $(this.$refs.table).DataTable({
                    "pagingType": "simple_numbers",
                    "language": {
                        "emptyTable": "The Person Listings table is empty",
                        "lengthMenu": "Display _MENU_ persons",
                        "loadingRecords": "Loading...",
                        "processing": "Processing...",
                        "zeroRecords": "No search results found",
                        "paginate": {
                            "next": "Next",
                            "previous": "Previous"
                        }
                    }
                });
            }); */
        },
        methods: {
            loadScript(src, callback) {
                const script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = src;
                script.onload = callback;
                document.head.appendChild(script);
            },
            initializeDataTable() {
                const table = this.$refs.table;
                if (table) {
                    console.log(table);
                    // DataTables is now loaded, you can initialize it here if needed
                    this.$nextTick(() => {
                        $(table).DataTable({
                            "pagingType": "simple_numbers",
                            "language": {
                                "emptyTable": "The Person Listings table is empty",
                                "lengthMenu": "Display _MENU_ persons",
                                "loadingRecords": "Loading...",
                                "processing": "Processing...",
                                "zeroRecords": "No search results found",
                                "paginate": {
                                    "next": "Next",
                                    "previous": "Previous"
                                }
                            }
                        });
                    });

                }
            }
        }
    }

</script>