<template>
    <div>
        <input type="text" name="text" v-model="text" style="color: black" class="mr-5">
        <AutoComplete :store_name="store_name" :text="text" @select-item="select_item"/>
    </div>
</template>

<script>
import AutoComplete from "@/components/Filtros/componentes/AutoComplete";

export default {

    name: "TextInput",
    components: {AutoComplete},
    props:{
        store_name: String
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
