<template>
    <table ref="table" :id="tableId" class="table table-bordered table-hover dataTable table-responsive table-fixed w-auto">
        <thead class="table-header-color align-middle">
            <tr>
                <th v-for="column in Object.keys(tableEntries[0])" >
                    {{ column }}
                </th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in tableEntries"  class="align-middle">
                <td v-for="item in Object.values(entry)">
                    {{ item ? item.value : '' }}
                </td>
                <td>
                    <button class="btn edit-button btn-custom">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                    <ModalComponent 
                        :modalId="'editModal'" 
                        :modalLabel="'editModalLabel'"
                        :modalTitle="editTitle"
                        :modalBtn="'Confirm'"
                        :entry="entry"
                        :actionRoute="`${routeName}.update`"
                        :modalContent="FormComponent"
                    />
                </td>
                <td>
                    <button class="btn delete-button btn-custom">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                    <ModalComponent 
                        :modalId="'deleteModal'" 
                        :modalLabel="'deleteModalLabel'"
                        :modalTitle="deleteTitle"
                        :modalBtn="'Confirm'"
                        :entry="entry"
                        :actionRoute="`${routeName}.destroy`"
                     />
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
    import FormComponent from './FormComponent.vue';

/*     import DataTable from 'datatables.net-dt';
    import 'datatables.net-dt/css/jquery.dataTables.css';
    import ModalComponent from './ModalComponent.vue';
 */
    export default {
        name: 'TableComponent',
        components: {
            ModalComponent
        },
        data() {
            return {
                FormComponent: FormComponent
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
            routeName: {
                type: String,
            }
        },
        mounted() {
            this.initializeDataTable();

            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(editBtn => {
                editBtn.addEventListener('click', (e) => this.editEntry(e));
            });

            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(deleteBtn => {
                deleteBtn.addEventListener('click', (e) => this.deleteEntry(e));
            });

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
                    new DataTable(this.$refs.table, {
                        autoWidth: true,
                        "pagingType": "simple_numbers",
                        "language": {
                            "emptyTable": "The Department Listings table is empty",
                            "lengthMenu": "Display _MENU_ entries",
                            "loadingRecords": "Loading...",
                            "processing": "Processing...",
                            "zeroRecords": "No search results found",
                            "paginate": {
                                "next": "Next",
                                "previous": "Previous"
                            },
                        }
                    });
                }
            },
            editEntry(e) {
                const editModal = e.target.closest('td').querySelector('#editModal');
                console.log(editModal);
                $(editModal).modal("show");
            },
            deleteEntry(e) {
                const deleteModal = e.target.closest('td').querySelector('#deleteModal');
                $(deleteModal).modal("show");
            }
        }
    }

</script>