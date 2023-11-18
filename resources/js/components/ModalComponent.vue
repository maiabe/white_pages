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
                    
                    <!-- Add conditionals for modal content -->

                    <component
                        :is="modalContent"
                        :entry="entry"
                        :actionRoute="actionRoute"
                    />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-button">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">{{ modalBtn }}</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import FormComponent from './FormComponent.vue';

    export default {
        name: 'ModalComponent',
        props: ['modalId', 'modalLabel', 'modalTitle', 'modalBtn', 'entry', 'actionRoute', 'modalContent'],
        components: {
            FormComponent,
        },
    }
</script>