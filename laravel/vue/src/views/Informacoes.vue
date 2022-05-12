<template>

</template>

<script>
export default {
    name: "Informacoes",
    mounted() {
        console.log(this.$route.query.instID)
        console.log(this.$route.query.cursoID)
    }
}
</script>

<style scoped>

</style>
