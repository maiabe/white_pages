
<template>
    <form :action="actionRoute" method="POST">
        <div v-for="field in entry" class="form-group">
            <label :for="field.name">{{ field.displayName }}</label>

            <input v-if="field.type=='text'"
                    :name="field.name" 
                    :type='field.type'
                    :value="field.value"
                    class="form-control"
            />
            <select v-if="field.type=='select'" class="form-select form-control">
                <option v-for="option in field.options">{{ option }}</option>
            </select>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            entry: {
                type: Object,
                /* required: true, */
            },
            actionRoute: {
                type: String,
                /* required: true, */
            },
        }
    }
</script>