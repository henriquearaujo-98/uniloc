import { createStore } from 'vuex'

const search_store = {
    namespaced : true,
    state: {
        distritos: [],
        cidades: [],
        instituicoes: [],
        areas: [],
        cursos: [],
        tipos_inst: [],
        exames: [],
        nota_min_min: [],
        nota_min_max: [],
        rank_min: [],
        rank_max: []
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
            console.log('ADD ' + item)
            console.log(this._modules.root.state.search_store[where])
            console.log(' -------------------------- ')
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
            console.log('Set slider ' + info.where)
            console.log(this._modules.root.state.search_store[where_min])
            console.log(this._modules.root.state.search_store[where_max])
            console.log(' -------------------------- ')
        }
    },
}

export default createStore({

  modules: {
      search_store : search_store
  }
})
