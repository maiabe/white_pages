<template>
    <table ref="table" :id="tableId" class="table table-bordered table-hover dataTable" >
        <thead class="table-header-color align-middle">
            <tr>
                <th v-for="column, index in displayColumns(tableEntries[0])" :key="index">
                    {{ column.columnName }}
                </th>
                <th v-if="this.editActionRoute" style="width: 3%">&nbsp;Edit&nbsp;</th>
                <th v-if="this.deleteActionRoute" style="width: 3%">Delete</th>
                <th v-if="this.approveActionRoute" style="width: 5%">Approve</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, i) in tableEntries"  :class="`align-middle ${isPending(row)}`" :key="i">
                <td  v-for="(column, j) in displayValues(row)" :key="j" >
                    {{ column ? column.value : '' }}
                </td>
                <td v-if="this.editActionRoute" style="width: 3%; text-align-last: center;">
                    <button :id="`${tableId}-edit-button-${i}`" class="btn btn-custom edit-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-edit-modal-${i}`">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :modalId="`${tableId}-edit-modal-${i}`"
                        :index="i"
                        :modalType="`${tableId}-edit`"
                        :modalTitle="editTitle"
                        :modalContent="EditComponent"
                        :entry="row"
                        :actionRoute="editActionRoute"
                    >
                        <EditComponent
                            :entry="row"
                            :actionRoute="editActionRoute"
                        />
                    </ModalComponent>
                </td>
                <td v-if="this.deleteActionRoute" style="width: 3%; text-align-last: center;">
                    <button :id="`${tableId}-delete-button-${i}`" class="btn btn-custom delete-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-delete-modal-${i}`">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :modalId="`${tableId}-delete-modal-${i}`"
                        :index="i"
                        :modalType="`${tableId}-delete`"
                        :modalTitle="deleteTitle"
                        :modalContent="DeleteComponent"
                        :entry="row"
                        :actionRoute="deleteActionRoute"
                    >
                        <DeleteComponent
                            :datasetType="tableName"
                            :entry="row"
                            :actionRoute="deleteActionRoute"
                        />
                    </ModalComponent>
                </td>
                <td v-if="this.approveActionRoute" style="width: 5%; text-align-last: center;">
                    <button :id="`${tableId}-approve-button-${i}`" class="btn btn-custom approve-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-approve-modal-${i}`">
                        <font-awesome-icon class="fa-icon" icon="check" style="font-size: larger;"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :modalId="`${tableId}-approve-modal-${i}`"
                        :index="i"
                        :modalType="`${tableId}-approve`"
                        :modalTitle="approveTitle"
                        :modalContent="ApproveComponent"
                        :entry="row"
                        :actionRoute="approveActionRoute"
                    >
                        <ApproveComponent
                            :datasetType="tableName"
                            :entry="row"
                            :actionRoute="approveActionRoute"
                        />
                    </ModalComponent>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import DataTable from 'datatables.net-dt';
    import 'datatables.net-dt/css/jquery.dataTables.css';
    import ModalComponent from './ModalComponent.vue';
    import EditComponent from './ModalContent/EditComponent.vue';
    import DeleteComponent from './ModalContent/DeleteComponent.vue';
    import ApproveComponent from './ModalContent/ApproveComponent.vue';

    export default {
        name: 'TableComponent',
        components: {
            ModalComponent,
        },
        data() {
            return {
                EditComponent: 'EditComponent',
                DeleteComponent: 'DeleteComponent',
                ApproveComponent: 'ApproveComponent',
            }
        },
        computed: {
            editTitle() {
                return `Edit ${this.tableName}`;
            },
            deleteTitle() {
                return `Delete ${this.tableName}`;
            },
            approveTitle() {
                return `Approve ${this.tableName}`;
            }
        },
        props: {
            tableName: {
                type: String,
                required: true,
            },
            tableId: {
                type: String,
                required: true,
            },
            tableColumns: {  
                type: Array
            },
            tableEntries: {  
                type: Array
            },
            editActionRoute: {
                type: String
            },
            deleteActionRoute: {
                type: String
            },
            approveActionRoute: {
                type: String
            }
        },
        mounted() {
            this.initializeDataTable();
            // make columns including 'Names' nowrap
            const table = this.$refs.table;
            const columns = this.displayColumns(this.tableEntries[0]);
            
            // find index of column that includes 'Name' in a title
            const tableHeaders = table.querySelectorAll('thead th');
            tableHeaders.forEach((th, i) => {
                const headerName = th.textContent;
                // if (headerName.includes('Name')) {
                if (headerName) {
                    //th.style.whiteSpace = 'nowrap';

                    // Set column width
                    const column = columns[i];
                    if (column) {
                        th.style.width = column.columnWidth;
                    } else { th.style.width = '5%'; }
                    
                    table.querySelectorAll('tbody tr').forEach(tr => {
                        const td = tr.querySelectorAll('td')[i];
                        td.style.whiteSpace = 'nowrap';
                        if (th.textContent.includes('Department Names')) {
                            td.style.whiteSpace = 'wrap';
                        }
                    });
                }
            });
        },
        methods: {
            initializeDataTable() {
                const table = this.$refs.table;
                if (table) {
                    new DataTable(this.$refs.table, {
                        // autoWidth: true,
                        dom: '<"filter-wrapper"lf><"table-wrapper"t><"paging-wrapper"ip>',
                        pagingType: "simple_numbers",
                        language: {
                            emptyTable: "Table is empty",
                            lengthMenu: "Display _MENU_ entries",
                            loadingRecords: "Loading...",
                            processing: "Processing...",
                            zeroRecords: "No search results found",
                            paginate: {
                                "next": "Next",
                                "previous": "Previous"
                            },
                            search: "",
                            searchPlaceholder: "Search Records",
                            // createdRow: function(row, data, i) {
                            //     console.log(row);
                            //     console.log(data);
                            // },
                        },
                    });
                }
            },
            displayColumns(tableColumns) {
                const keys = Object.keys(tableColumns);
                const columns = [];
                keys.forEach(column => {
                    if (tableColumns[column].display === 'true') {
                        columns.push(tableColumns[column]);
                    }
                });
                return columns;
            },
            displayValues(row) {
                const keys = Object.keys(row);
                const values = [];
                keys.forEach(value => {
                    if ((row[value].display === 'true')) {
                        values.push(row[value]);
                    }
                });
                return values;
            },
            isPending(row) {
                const pending = row['pending'];
                if (pending) {
                    return 'table-warning';
                }
            },
        }
    }

</script>