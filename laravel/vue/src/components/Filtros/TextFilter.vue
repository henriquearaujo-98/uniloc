<!-- TextFilter component -->
<template>
    <div style="width: 100%; max-height: 15px" class="p-5;">
        <div class="flex">
            <label class="self-start">{{ label }}</label>
        </div>

        <div class="flex" style="position: relative; max-width: 100%">
            <TextInput :pool="pool" @select-item="add_item"/>

            <ResultsArea :selected="selected" />

        </div>

    </div>
</template>
<!-- Filter component -->

<script>
import TextInput from "@/components/Filtros/componentes/TextInput";
import AutoComplete from "@/components/Filtros/componentes/AutoComplete";
import ResultsArea from "@/components/Filtros/componentes/ResultsArea";

export default {
    name: "TextFilter",
    props:{
        label: String,
        tabela: String
    },
    components: {AutoComplete, TextInput, ResultsArea},
    data(){
        return {
            selected: [],   // items selecionados do dropdown para fazer request á api
            pool: [],  // pool de informação

        }
    },
    created() {
        this.pool = [
            {
                id: 0,
                nome: 'Açores'
            },
            {
                id: 1,
                nome: 'Bragança'
            },
            {
                id: 2,
                nome: 'Braga'
            },
            {
                id: 3,
                nome: 'Porto'
            },
            {
                id: 4,
                nome: 'Viana do Castelo'
            },
            {
                id: 5,
                nome: 'Vila Real'
            },
            {
                id: 6,
                nome: 'Santarem'
            },
            {
                id: 7,
                nome: 'Lisboa'
            },
            {
                id: 8,
                nome: 'Aveiro'
            },
            {
                id: 9,
                nome: 'Algarve'
            }
        ];
    },
    methods:{
        add_item(item){
            this.selected.push(item)
            console.log(item)
        }


    },

}
</script>

<style scoped>




</style>
