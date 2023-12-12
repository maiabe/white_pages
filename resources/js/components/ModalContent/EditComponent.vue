<template>
    <!-- Create form -->
    <FormComponent
        :formInputs="getFormInputs(entry)"
        :actionRoute="actionRoute"
        :modalId="modalId"
    />
    
</template>

<script>
    import FormComponent from '../FormComponent.vue';

    export default {
        name: 'EditComponent',
        props: {
            entry: {
                type: Object
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
                const keys = Object.keys(entry);
                const fields = [];
                // Get each field (column) information from an entry (row) of a table
                keys.forEach(value => {
                    fields.push(entry[value]);
                });
                // Get formInput fields to pass to the form component
                const formInputs = [];
                fields.forEach(f => {
                    if (f.formInput) {
                        formInputs.push(f.formInput);
                    }
                });
                // console.log(formInputs);
                return formInputs;
            }
        }
    }
</script>