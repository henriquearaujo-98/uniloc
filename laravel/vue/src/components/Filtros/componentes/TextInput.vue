<template>
    <div>
        <input type="text" name="text" autocomplete="off" v-model="text" style="color: black" class="mr-5">
        <AutoComplete :store_name="store_name" :text="text" />
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

    },

}
</script>

<style scoped>
input{
    position: relative;
}
</style>
