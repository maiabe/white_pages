
<template>
    <form :action="actionRoute" method="POST">
        <div v-for="field in entry" class="form-group">
            <label for="{{ field.key }}">{{ field.key }}</label>
            <input type="{{ entry[field].type }}" class="form-control" />
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            actionRoute: {
                type: String,
                required: true,
            },
            entry: {
                type: Object,
                required: true,
            },
        }
    }
</script>