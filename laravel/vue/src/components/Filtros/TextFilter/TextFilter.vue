
<template>
    <div style="width: 100%;" class="pl-5  text-filter">
        <div class="flex">
            <label class="self-start">{{ label }}</label>
        </div>

        <div class="flex input">
            <TextInput :store_name="this.tabela"/>
            <ResultsArea :store_name="this.tabela" />
        </div>

    </div>
    <hr style="margin-bottom: 5px">
</template>

<script>
import TextInput from "@/components/Filtros/TextFilter/componentes/TextInput";
import AutoComplete from "@/components/Filtros/TextFilter/componentes/AutoComplete";
import ResultsArea from "@/components/Filtros/TextFilter/componentes/ResultsArea";
import axios from 'axios';

import store from "@/store";

export default {
    name: "TextFilter",
    props:{
        label: String,
        tabela: String,
    },
    components: {AutoComplete, TextInput, ResultsArea},
    created() {
        // register a module
        this.$store.registerModule(this.tabela, {
            namespaced: true,
            state: {
                selected: [],   // items selecionados do dropdown para fazer request á api
                options: [],    // seleção a partir da pool correspondente ao texto dado pelo utilizador
                pool: [],  // pool de informação
                show : false    // Booleano para mostrar a caixa de sugestão
            },
            mutations: {

                POPULATE_POOL(state, data){
                    //console.log(data)
                    state.pool = data;
                    //state.pool.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    //console.log('done loading data')
                },

                SELECT_ITEM(state, item){

                    state.selected.push(item)
                    state.options.splice(state.options.indexOf(item),1)
                },

                REMOVE_ITEM(state, item){

                    let temp = state.selected.filter((i) => {
                        if(i != item){
                            return true
                        }
                    })
                    state.selected = temp;
                    state.options.push(item)
                    state.options.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.selected.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                },

                GET_DROPDOWN(state, text){
                    state.options = [];

                    if(!text && state.selected.length  == 0) {
                        state.options = [...state.pool];
                        return;
                    }

                    if(state.selected.length > 0){
                        let temp  = []

                        state.pool.forEach(element => {                                         // Popular uma variável temporario com elementos que correspondem ao filtro
                            if (element.nome.toUpperCase().indexOf(text.toUpperCase()) !== -1) {
                                temp.push(element)
                            }
                        })

                        state.options = temp.filter(value => !state.selected.includes(value));


                    }else{
                        state.pool.forEach(element => {                                         // Popular uma variável temporario com elementos que correspondem ao filtro
                            if (element.nome.toUpperCase().indexOf(text.toUpperCase()) !== -1) {
                                state.options.push(element)
                            }
                        })


                    }

                    /*let set = new Set(state.options)    // Garantir que apenas existe um de cada
                    state.options = Array.from(set);*/

                    //console.log(state.pool.length)

                },

                SORT_STATE(state){
                    /*state.selected.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.options.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))
                    state.pool.sort((a,b) => (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0))*/
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
    },
    mounted() {
        console.log(JSON.parse(localStorage.getItem(this.tabela)))
        if(!localStorage.hasOwnProperty(this.tabela)){
            const url = `${this.$store.state['networking_store'].API_BASE_URL}/${this.tabela}`
            axios
                .get(url)
                .then(response => {
                    this.$store.dispatch(`${this.tabela}/populate_pool`, response.data)[this.tabela];
                    console.log('fetching from DB')
                    localStorage.setItem('last_updated', new Date())
                    console.log(response.data)
                    localStorage.setItem(this.tabela, JSON.stringify(response.data))
                    this.$emit('done_loading');
                })
        }else{
            console.log('fetching from LocalStorage')

            this.$store.dispatch(`${this.tabela}/populate_pool`,JSON.parse(localStorage.getItem(this.tabela)))[this.tabela];
            this.$emit('done_loading');
        }


        const el = this.$el;

        document.addEventListener('click', (e) => {
           if(!el.contains(e.target)){
               this.$store.state[this.tabela].show = false
           }
        });



    },

}
</script>

<style scoped>

.input{
    max-width: 100%; margin-bottom: 15px
}

@media screen and (max-height: 859px){
    label{
        font-size: 16px;
    }

    .input{
        max-width: 100%;
        margin-bottom: 0px
    }
}


</style>
