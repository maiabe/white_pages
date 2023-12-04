<template>
    <table ref="table" :id="tableId" class="table table-bordered table-hover dataTable" >
        <thead class="table-header-color align-middle">
            <tr>
                <th v-for="column, index in displayColumns(tableEntries[0])" :key="index">
                    {{ column.columnName }}
                </th>
                <th v-if="this.editActionRoute" style="width: 5%">&nbsp;Edit&nbsp;</th>
                <th v-if="this.editActionRoute" style="width: 5%">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(entry, i) in tableEntries"  class="align-middle" :key="i">
                <td v-for="(item, j) in displayValues(entry)" :key="j">
                    {{ item ? item.value : '' }}
                </td>
                <td v-if="this.editActionRoute" style="width: 5%">
                    <button :id="`${tableId}-edit-button-${i}`" class="btn btn-custom edit-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-edit-modal-${i}`">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :modalId="`${tableId}-edit-modal-${i}`"
                        :index="i"
                        :modalType="`${tableId}-edit`"
                        :modalTitle="editTitle"
                        :modalContent="EditComponent"
                        :entry="entry"
                        :actionRoute="editActionRoute"
                    >
                        <EditComponent
                            :entry="entry"
                            :actionRoute="editActionRoute"
                        />
                    </ModalComponent>
                </td>
                <td v-if="this.deleteActionRoute" style="width: 5%">
                    <button :id="`${tableId}-delete-button-${i}`" class="btn btn-custom delete-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-delete-modal-${i}`">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :modalId="`${tableId}-delete-modal-${i}`"
                        :index="i"
                        :modalType="`${tableId}-delete`"
                        :modalTitle="deleteTitle"
                        :modalContent="DeleteComponent"
                        :entry="entry"
                        :actionRoute="deleteActionRoute"
                    >
                        <DeleteComponent
                            :datasetType="tableName"
                            :entry="entry"
                            :actionRoute="deleteActionRoute"
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

    export default {
        name: 'TableComponent',
        components: {
            ModalComponent,
        },
        data() {
            return {
                EditComponent: 'EditComponent',
                DeleteComponent: 'DeleteComponent',
            }
        },
        computed: {
            editTitle() {
                return `Edit ${this.tableName}`;
            },
            deleteTitle() {
                return `Delete ${this.tableName}`;
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
            }
        },
        mounted() {
            this.initializeDataTable();
            // make columns including 'Names' nowrap
            const table = this.$refs.table;
            // find index of column that includes 'Name' in a title
            const tableHeaders = table.querySelectorAll('thead th');
            tableHeaders.forEach((th, i) => {
                const headerName = th.textContent;
                if (headerName.includes('Name')) {
                    th.style.whiteSpace = 'nowrap';

                    table.querySelectorAll('tbody tr').forEach(tr => {
                        const td = tr.querySelectorAll('td')[i];
                        td.style.whiteSpace = 'nowrap';
                    });
                }
            });
        },
        methods: {
            initializeDataTable() {
                const table = this.$refs.table;
                if (table) {
                    new DataTable(this.$refs.table, {
                        autoWidth: true,
                        dom: '<"filter-wrapper"lf><"table-wrapper"t><"paging-wrapper"ip>',
                        pagingType: "simple_numbers",
                        language: {
                            emptyTable: "The Department Listings table is empty",
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
                        },
                        // scrollX: true,
                        // fixedColumns: {
                        //         leftColumns: 0,
                        //         rightColumns: 2
                        //     },
                        
                    });
                }
            },
            displayColumns(tableColumns) {
                const keys = Object.keys(tableColumns);
                const columns = [];
                keys.forEach(column => {
                    if (tableColumns[column].inputType !== 'hidden') {
                        columns.push(tableColumns[column]);
                    }
                });
                return columns;
            },
            displayValues(entry) {
                const keys = Object.keys(entry);
                const values = [];
                keys.forEach(value => {
                    if (entry[value].inputType !== 'hidden') {
                        values.push(entry[value]);
                    }
                });
                return values;
            }
        }
    }

</script>