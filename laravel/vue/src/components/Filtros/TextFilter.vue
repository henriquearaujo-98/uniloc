
<template>
    <div style="width: 100%; max-height: 15px" class="p-5;"
            @focusin="this.$store.state[this.tabela].show = true"
            @focusout="this.$store.state[this.tabela].show = false">
        <div class="flex">
            <label class="self-start">{{ label }}</label>
        </div>

        <div class="flex" style="max-width: 100%;">
            <TextInput :store_name="this.tabela" @select-item="add_item"/>
            <ResultsArea :store_name="this.tabela" @remove-item="remove_item" />
        </div>

    </div>
</template>

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
        axios
            .get(`http://localhost:3500/api/${this.tabela}`)
            .then(response => (this.$store.dispatch(`${this.tabela}/populate_pool`, response.data)[this.tabela]))

        // register a module
        this.$store.registerModule(this.tabela, {
            namespaced: true,
            state: {
                selected: [],   // items selecionados do dropdown para fazer request á api
                options: [],
                pool: [],  // pool de informação
                show : false
            },
            getters: {
            },
            mutations: {

                POPULATE_POOL(state, data){
                    state.pool = data;
                    state.pool.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.options = state.pool
                },

                SELECT_ITEM(state, item){
                    state.selected.push(item)
                    state.options.splice(state.options.indexOf(item),1)
                },

                REMOVE_ITEM(state, item){

                    let temp = state.selected.filter((i) => {
                        if(i !== item){
                            return true
                        }
                    })
                    state.selected = temp;
                    state.options.push(item)
                    state.options.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.selected.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                },

                GET_DROPDOWN(state, text){

                    if(text === ''){
                        state.options = state.pool;
                        return;
                    }

                    let temp = [];
                    state.pool.forEach(element => {        // Por cada elemento da pool
                        let nome = element.nome.substr(0, element.nome.indexOf('('))    // Quero comparar a primeira parte, ou seja, o nome da cidade em si e não o municipio
                        if (nome.toUpperCase().indexOf(text.toUpperCase()) !== -1) {    // Convertemos tudo para uppercase para se poder comparar devidamente
                            if(state.selected.length){                                  // Se ja temos algo selecionado
                                state.selected.forEach(item => {                        // Garantimos que não aparece nas opções
                                    if(item != nome)
                                        temp.push(element)
                                })
                            }else{                                                      // Caso contrário, pomos como opção
                                temp.push(element)
                            }
                        }
                    })

                    state.options = temp;
                    state.options.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                },

                SORT_STATE(state){
                    state.selected.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.options.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.pool.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
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
                },

                get_dropdown({commit}, text){
                    commit('GET_DROPDOWN', text)
                }
            },
        })
        console.log(`Store ${this.tabela} exists? ${this.$store.hasModule("/"+this.tabela)}`)
    },
    mounted() {



    },
    methods:{
        add_item(item){
            this.$store.dispatch(`${this.tabela}/select_item`, item)[this.tabela]
        },

        remove_item(item){
            this.$store.dispatch(`${this.tabela}/remove_item`, item)[this.tabela]
        }


    },

}
</script>

<style scoped>




</style>
