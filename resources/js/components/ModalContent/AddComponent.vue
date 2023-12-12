<template>
    <!-- Create form -->
    <FormComponent
        :formInputs="getFormInputs(entry)"
        :actionRoute="actionRoute"
        :modalId="modalId"
    />
    <!-- <div class="button-wrapper">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-button">
            Close
        </button>
        <button type="submit" ref="submitButton" :id="`${modalId}-submit`" class="btn btn-add submit-button">
            Confirm
        </button>
    </div> -->
</template>

<script>
    import FormComponent from '../FormComponent.vue';

    export default {
        name: 'AddComponent',
        props: {
            entry: {
                type: Object,
                required: false,
            },
            actionRoute: {
                type: String
            },
            
            modalId: {
                type: String
            }
        },
        components: {
            FormComponent
        },
        methods: {
            getFormInputs(entry) {
                const firstRow = entry[0];
                // Get each field (column) information from an entry (row) with empty values
                const fields = [];
                Object.keys(firstRow).forEach(key => {
                    // firstRow[key].value = '';
                    if (typeof(firstRow[key]) == 'object') {
                        fields.push(firstRow[key]);
                    }
                });
                // Get formInput fields to pass to the form component
                const formInputs = [];
                fields.forEach(f => {
                    const input = f.formInput;
                    if (input) {
                        const value = f.formInput['inputType'] == 'radio' ? input.value : '';
                        input.value = value;
                        formInputs.push(f.formInput);
                    }
                });
                // console.log(formInputs);
                return formInputs;
            }
        }
    }
</script>