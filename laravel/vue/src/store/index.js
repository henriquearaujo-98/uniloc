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
        provas: [],
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
            const where = info.where;
            this._modules.root.state.search_store[where].splice(this._modules.root.state.search_store[where].indexOf(item.ID),1)
            console.log('REMOVE ' + item)
            console.log(this._modules.root.state.search_store[where])
            console.log(' -------------------------- ')
        },
    },
}

export default createStore({

  modules: {
      search_store : search_store
  }
})
