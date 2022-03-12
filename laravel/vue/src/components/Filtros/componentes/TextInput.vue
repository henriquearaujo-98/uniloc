<template>
    <div>
        <input type="text" name="text" autocomplete="off" v-model="text" style="color: black" class="mr-5" @focusin="onFocus">
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
        onFocus(){
            console.log('focus')
            this.$store.dispatch(`${this.store_name}/get_dropdown`, '')[this.tabela]
        }
    },

}
</script>

<style scoped>
input{
    position: relative;
}
</style>
