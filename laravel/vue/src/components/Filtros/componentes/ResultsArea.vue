<template>
    <div class="inline overflow-x-scroll flex-1" style="position: relative; height: 50px">
                <span v-for="item in this.$store.state[this.store_name].selected" :key="item.id" @click="$emit('remove-item', item)" class="mr-3">
                    {{item.nome}}
                </span>
    </div>
</template>

<script>
export default {
    name: "ResultsArea",
    props:{
        store_name: String
    },
}
</script>

<style scoped>
span{
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    border-radius: 15px;
    background: dimgrey;
    padding: 5px 10px;
}

span:hover{
    cursor: pointer;
    background: darkgrey;
}
</style>
