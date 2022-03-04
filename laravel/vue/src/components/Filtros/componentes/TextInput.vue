<template>
    <div>
        <input type="text" name="text" v-model="text" style="color: black" class="mr-5">
        <AutoComplete :pool="pool" :text="text" @select-item="select_item"/>
    </div>
</template>

<script>
import AutoComplete from "@/components/Filtros/componentes/AutoComplete";

export default {

    name: "TextInput",
    components: {AutoComplete},
    props:{
        pool: Array
    },
    data(){
        return{
            text : ''
        }
    },
    methods:{

        select_item(item){
            this.$emit('select-item', item)

        }
    },

}
</script>

<style scoped>

</style>
