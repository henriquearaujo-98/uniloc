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
import axios from 'axios';

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

                POPULATE_POOL(state, data){
                    state.pool = data;
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

                populate_pool({commit}, data){
                    commit('POPULATE_POOL', data)
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

        let data = axios
            .get(`http://localhost:3500/api/${this.tabela}`)
            .then(response => (this.$store.dispatch('populate_pool', response.data)[this.tabela]))
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
