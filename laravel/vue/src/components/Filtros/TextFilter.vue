<!-- TextFilter component -->
<template>
    <div style="width: 100%; max-height: 15px" class="p-5;">
        <div class="flex">
            <label class="self-start">{{ label }}</label>
        </div>

        <div class="flex" style="position: relative; max-width: 100%">
            <TextInput :store_name="this.tabela" @select-item="add_item"/>

            <ResultsArea :store_name="this.tabela" @remove-item="remove_item" />

        </div>

    </div>
</template>
<!-- Filter component -->

<script>
import TextInput from "@/components/Filtros/componentes/TextInput";
import AutoComplete from "@/components/Filtros/componentes/AutoComplete";
import ResultsArea from "@/components/Filtros/componentes/ResultsArea";

import store from "@/store";

export default {
    name: "TextFilter",
    props:{
        label: String,
        tabela: String
    },
    components: {AutoComplete, TextInput, ResultsArea},
    created() {
        // register a module
        this.$store.registerModule(this.tabela, {
            state: {
                selected: [],   // items selecionados do dropdown para fazer request á api
                options: [],
                pool: [],  // pool de informação
            },
            getters: {
            },
            mutations: {

                POPULATE_POOL(state){
                    state.pool =  [
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

                SELECT_ITEM(state, item){
                    state.selected.push(item)
                },

                REMOVE_ITEM(state, item){

                    let temp = state.selected.filter((i) => {
                        if(i !== item){
                            //console.log(item)
                            return true
                        }
                    })
                    state.selected = temp;
                    state.options.push(item)
                    console.log(state.selected)

                }
            },
            actions: {

                populate_pool({commit}){
                    commit('POPULATE_POOL')
                },

                select_item({commit}, item){
                    commit('SELECT_ITEM', item)
                },

                remove_item({commit}, item){
                    commit('REMOVE_ITEM', item)
                }
            },
        })
    },
    mounted() {
        this.$store.dispatch('populate_pool')[this.tabela]

    },
    methods:{
        add_item(item){
            this.$store.dispatch('select_item', item)[this.tabela]
        },

        remove_item(item){
            this.$store.dispatch('remove_item', item)[this.tabela]
        }


    },

}
</script>

<style scoped>




</style>
