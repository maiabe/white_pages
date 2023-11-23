<template>
    <div>AddComponent</div>
    <!-- Create form -->
    <FormComponent
        :actionRoute="actionRoute"
    />

</template>

<script>
    import FormComponent from '../FormComponent.vue';

    export default {
        name: 'AddComponent',
        props: {
            actionRoute: {
                type: String
            }
        },
        components: {
            FormComponent
        }
    }
</script>