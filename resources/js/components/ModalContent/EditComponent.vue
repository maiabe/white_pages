<template>
    <!-- Create form -->
    <FormComponent
        :entry="entry"
        :actionRoute="actionRoute"
        :submitButtonId="submitButtonId" 
        
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
            submitButtonId: {
                type: String
            }
        },
        components: {
            FormComponent
        },
        mounted() {
            /* const button = document.getElementById(this.submitButtonId);
            button.addEventListener('click', this.submitFormTest); */
        },
    }
</script>