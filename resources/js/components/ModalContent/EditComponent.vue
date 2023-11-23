<template>
    <!-- Create form -->
    <FormComponent 
        :entry="entry"
        :actionRoute="actionRoute"
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
            }
        },
        components: {
            FormComponent
        }
    }
</script>