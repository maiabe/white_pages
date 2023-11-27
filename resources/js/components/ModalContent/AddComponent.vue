<template>
    <div>AddComponent</div>
    <!-- Create form -->
    <FormComponent
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
            submitButtonId: {
                type: String
            }
        },
        components: {
            FormComponent
        }
    }
</script>