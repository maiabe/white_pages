<template>
    <table ref="table" :id="tableId" class="table table-bordered table-hover dataTable table-responsive table-fixed w-auto text-center">
        <thead class="table-header-color align-middle">
            <tr>
                <th v-for="column in Object.keys(tableEntries[0])" >
                    {{ column }}
                </th>
                <th style="width: 55px">Edit</th>
                <th style="width: 55px">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(entry, index) in tableEntries"  class="align-middle">
                <td v-for="item in Object.values(entry)">
                    {{ item ? item.value : '' }}
                </td>
                <td style="width: 55px">
                    <button :id="`${tableId}-edit-button-${index}`" class="btn btn-custom edit-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-edit-modal-${index}`">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :modalId="`${tableId}-edit-modal-${index}`"
                        :index="index"
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
                <td style="width: 55px">
                    <button :id="`${tableId}-delete-button-${index}`" class="btn btn-custom delete-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-delete-modal-${index}`">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                    <!-- <ModalComponent
                        :index="index"
                        :modalType="`${tableId}-delete`"
                        :modalTitle="deleteTitle"
                        :modalContent="DeleteComponent"
                        :entry="entry"
                    >
                        <DeleteComponent
                            :entry="entry"
                            :actionRoute="deleteRouteAction"
                        />
                    </ModalComponent> -->

                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
    import JQuery from 'jquery';
    import DataTable from 'datatables.net-dt';
    import 'datatables.net-dt/css/jquery.dataTables.css';
    import ModalComponent from './ModalComponent.vue';
    import EditComponent from './ModalContent/EditComponent.vue';
    import DeleteComponent from './ModalContent/DeleteComponent.vue';

    /*     
    import DataTable from 'datatables.net-dt';
    import 'datatables.net-dt/css/jquery.dataTables.css';
    import ModalComponent from './ModalComponent.vue';
 */
    export default {
        name: 'TableComponent',
        components: {
            ModalComponent,
        },
        data() {
            return {
                EditComponent: 'EditComponent',
                DeleteComponent: 'DeleteComponent'
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
            console.log(this.editActionRoute);
            this.initializeDataTable();
            /* const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(editBtn => {
                editBtn.addEventListener('click', (e) => this.editEntry(e));
            });

            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(deleteBtn => {
                deleteBtn.addEventListener('click', (e) => this.deleteEntry(e));
            }); */

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
                            searchPlaceholder: "Search Records"
                        }
                    });
                }
            },
        }
    }

</script>