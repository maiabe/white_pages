<template>
    <!-- Create form -->
    <FormComponent
        :entry="this.fields"
        :actionRoute="actionRoute"
        :modalId="modalId"
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
            modalId: {
                type: String
            }
        },
        data() {
            console.log(this.entry);
            const obj = this.entry[0];
            const fields = Object.keys(obj).map(key => {
                obj[key].value = '';
                return obj[key];
            });
            
            return { fields }
        },
        components: {
            FormComponent
        }
    }
</script>