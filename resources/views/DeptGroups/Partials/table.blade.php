
<table id="dept_grps" class="table table-bordered table-hover dataTable table-responsive table-fixed w-auto">
    <thead class="table-header-color align-middle">
        <tr>
            @foreach($columnNames as $column)
                <th>
                    {{ $column }}
                </th>
            @endforeach
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $item)
            <tr class="align-middle">
                @foreach($item as $field)
                    <td>
                        {{ $field['value'] }}
                    </td>
                @endforeach
                <td>
                    <button id="dept_grps_edit-button-{{$index}}" class="btn btn-custom edit-button" data-bs-toggle="modal" data-bs-target="#deptgrps-edit-modal-{{$index}}">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                    <modal-component
                        :modal-id="`deptgrps-edit-modal-{{ $index }}`"
                        :index="{{ $index }}"
                        :modal-title="'Edit Department Group'"
                        :modal-content="'EditComponent'"
                        :entry="{{ json_encode($item) }}"
                        :action-route="'{{ route('dept_groups.update') }}'"
                    >
                        <edit-component />
                    </modal-component>
                </td>
                <td>
                    <button id="dept_grps_delete-button-{{$index}}" class="btn btn-custom delete-button" data-bs-toggle="modal" data-bs-target="#deptgrps-delete-modal-{{$index}}">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                    
                </td>
            </tr> 
        @endforeach
    </tbody>

        <!-- <tbody>
            <tr v-for="(entry, index) in tableEntries"  class="align-middle">
                <td v-for="item in Object.values(entry)">
                </td>
                <td>
                    <button :id="`${tableId}-edit-button-${index}`" class="btn btn-custom edit-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-edit-modal-${index}`">
                        <font-awesome-icon class="fa-icon" icon="pencil"></font-awesome-icon>
                    </button>
                    <ModalComponent
                        :index="index"
                        :modalType="`${tableId}-edit`"
                        :modalTitle="editTitle"
                        :modalContent="EditComponent"
                        :entry="entry"
                    >
                        <EditComponent
                            :entry="entry"
                            :actionRoute="editRouteAction"
                        />
                    </ModalComponent>
                </td>
                <td>
                    <button :id="`${tableId}-delete-button-${index}`" class="btn btn-custom delete-button" data-bs-toggle="modal" :data-bs-target="`#${tableId}-delete-modal-${index}`">
                        <font-awesome-icon class="fa-icon" icon="trash"></font-awesome-icon>
                    </button>
                     <ModalComponent
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
                    </ModalComponent>

                </td>
            </tr>
        </tbody> -->
    </table>