<template>
    <div class="inline overflow-x-scroll flex-1" style="position: relative; height: 50px">
                <span v-for="item in selected" :key="item.id"  class="mr-3">
                    {{item.nome}}
                </span>
    </div>
</template>

<script>
export default {
    name: "ResultsArea",
    props:{
        selected: Array
    }
}
</script>

<style scoped>
span{
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}
</style>
