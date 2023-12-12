<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" :aria-labelledby="`modalLabel`" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="`modalLabel`">
                        {{ modalTitle }}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            id="x-button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <slot name="header"></slot>
                </div>
                <div class="modal-body">
                    <!-- Add conditionals for modal content -->
                    <component
                        :is="this.resolveComponentName"
                        v-if="entry !== undefined"
                        :entry="entry"
                        :actionRoute="actionRoute"
                        :modalId="modalId"
                    />
                    <component v-else
                        :is="this.resolveComponentName"
                        :actionRoute="actionRoute"
                        :modalId="modalId"
                    />

                </div>
                <!-- <div v-if="this.actionRoute.includes('approve')" class="modal-footer">
                    <button type="button" class="btn btn-reject" id="reject-button">
                        Reject
                    </button>
                    <button type="submit" ref="submitButton" :id="`${modalId}-submit`" class="btn btn-approve submit-button">
                        Approve
                    </button>
                </div>
                <div v-else class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-button">
                        Close
                    </button>
                    <button type="submit" ref="submitButton" :id="`${modalId}-submit`" class="btn btn-primary submit-button">
                        Confirm
                    </button>
                </div> -->
            </div>
        </div>
    </div>

</template>

<script>
    import AddComponent from './ModalContent/AddComponent.vue';
    import EditComponent from './ModalContent/EditComponent.vue';
    import DeleteComponent from './ModalContent/DeleteComponent.vue';
    import ApproveComponent from './ModalContent/ApproveComponent.vue';

    export default {
        name: 'ModalComponent',
        components: {
            AddComponent,
            EditComponent,
            DeleteComponent,
            ApproveComponent
        },
        computed: {
            resolveComponentName() {
                const componentMap = {
                    'AddComponent': AddComponent,
                    'EditComponent': EditComponent,
                    'DeleteComponent': DeleteComponent,
                    'ApproveComponent': ApproveComponent,
                }
                return componentMap[this.modalContent] || DefaultComponent;
            }
        },
        props: {
            modalId: {
                type: String,
            },
            index: {
                type: Number
            },
            modalTitle: {
                type: String
            },
            entry: {
                type: Object,
                required: false
            },
            actionRoute: {
                type: String
            },
            modalContent: {
                type: String
            }
        },
    }
</script>