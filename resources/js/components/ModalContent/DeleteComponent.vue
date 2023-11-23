<template>

    <h3>
        DeleteModalContent
    </h3>

    <div>
        {{ entry }}
    </div>

</template>

<script>
    export default {
        name: 'DeleteComponent',
        props: {
            entry: {
                type: Object
            },
            actionRoute: {
                type: String
            }
        }
    }
</script>