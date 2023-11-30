<template>
    <!-- Create form -->
    <FormComponent
        :entry="this.fields"
        :actionRoute="actionRoute"
        :submitButtonId="submitButtonId"
    />

</template>

<script>
    import FormComponent from '../FormComponent.vue';

    export default {
        name: 'AddComponent',
        props: {
            actionRoute: {
                type: String
            },
            entry: {
                type: Object,
                required: false,
            },
            submitButtonId: {
                type: String
            }
        },
        data() {
            const obj = this.entry[0];
            const fields = Object.keys(obj).map(key => {
                obj[key].value = '';
                return obj[key];
            });
            
            console.log(fields);
            return { fields }
        },
        components: {
            FormComponent
        }
    }
</script>