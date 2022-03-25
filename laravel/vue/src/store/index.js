import { createStore } from 'vuex'
import axios from "axios";

/// Monitorização e manipulação de dados obrigatórios para a chamada á API laravel
const search_store = {
    namespaced : true,
    state: {
        distritos: [],
        cidades: [],
        instituicoes: [],
        tipos_ensino: [],
        area_estudo: [],
        cursos: [],
        exames: [],
        nota_min_min: '0',
        nota_min_max: '200',
        rank_min: '',
        rank_max: ''
    },
    getters: {
    },
    mutations: {

    },
    actions: {
        add({commit}, info){
            const item = info.item;
            const where = info.where;
            this._modules.root.state.search_store[where].push(item.ID)
            // console.log('ADD ' + item)
            // console.log(this._modules.root.state.search_store[where])
            // console.log(' -------------------------- ')
        },
        remove({commit}, info){
            const item = info.item;
            const where = info.where; // Nome da variável
            this._modules.root.state.search_store[where].splice(this._modules.root.state.search_store[where].indexOf(item.ID),1)
            console.log('REMOVE ' + item)
            console.log(this._modules.root.state.search_store[where])
            console.log(' -------------------------- ')
        },
        set_slider({commit}, info){
            const min = info.min;
            const max = info.max
            const where_min = info.where + '_min';
            const where_max = info.where + '_max';
            this._modules.root.state.search_store[where_min] = min;
            this._modules.root.state.search_store[where_max] = max;
        },
        unset_slider({commit}, where){
            const where_min = where + '_min';
            const where_max = where + '_max';

            this._modules.root.state.search_store[where_min] = '';
            this._modules.root.state.search_store[where_max] = '';
            console.log(this._modules.root.state.search_store)
        }
    },
}

/// Chamada á API laravel com os atributos da search store
const results_store = {
    namespaced : true,
    state: {
        results : []
    },
    getters: {
    },
    mutations: {

    },
    actions: {
        async get_request({commit}, data){
            /*const res = await axios.get('https://httpbin.org/get', {
                headers: {
                    'Cache-Control': 'no-cache',
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                    'Accept-Encoding': 'gzip, deflate, br',
                    'Connection' : 'keep-alive'
                },
                params: {
                    'distritos':
                }
            });*/
        }
    },
}

export default createStore({

  modules: {
      search_store : search_store,
      results_store : results_store
  }
})
