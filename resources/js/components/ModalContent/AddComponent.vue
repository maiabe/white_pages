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
                        input.value = '';
                        formInputs.push(f.formInput);
                    }
                });
                // console.log(formInputs);
                return formInputs;
            }
        }
    }
</script>