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
            // console.log('REMOVE ' + item)
            // console.log(this._modules.root.state.search_store[where])
            // console.log(' -------------------------- ')
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
        }
    },
}

/// Chamada á API laravel com os atributos da search store
const results_store = {
    namespaced : true,
    state: {
        results : [],
        results_unique : [],
        done: Boolean
    },
    mutations: {
        POPULATE_RESULTS(state, data){
            state.results = data;
            state.results_unique = data.filter((obj, pos, arr) => {
                return arr
                    .map(mapObj => mapObj.instituicoes_ID)
                    .indexOf(obj.instituicoes_ID) == pos;
            });

            console.log(state.results_unique)
        }
    },
    getters: {
        len (state) {
            return state.results
        }
    },
    actions: {
        async get_request({commit}, data){
            this.state.done = false
            let formdata = new FormData();
            // formdata.append("distritos", data.distritos);
            // formdata.append("cidade", data.cidade);
            // formdata.append("insts", data.insts);
            // formdata.append("areas", data.areas);
            // formdata.append("cursos", data.cursos);
            // formdata.append("tipos_inst", data.tipos_inst);
            // formdata.append("provas", data.provas);
             formdata.append("nota_min_min", data.nota_min_min);
             formdata.append("nota_min_max", data.nota_min_max);
            // formdata.append("rank_min", data.rank_min);
            // formdata.append("rank_max", data.rank_max);
            formdata.append("distritos", 10);
            // formdata.append("tipos_inst", 12);


            const res = await axios.post('http://localhost:3500/api/search', formdata,
      {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                },

            }).then(r => commit('POPULATE_RESULTS', r.data));
        },
    },
}

export default createStore({

  modules: {
      search_store : search_store,
      results_store : results_store
  }
})


