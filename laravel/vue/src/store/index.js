import { createStore } from 'vuex'
import axios from "axios";

/// Monitorização e manipulação de dados obrigatórios para a chamada á API laravel
const search_store = {
    namespaced : true,
    state: {
        distritos: [],
        municipios: [],
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
            let insts_IDs = {}

            data.forEach(function(obj) {
                if(insts_IDs[obj.instituicoes_ID] === undefined)
                    insts_IDs[obj.instituicoes_ID] = []
            });

            data.forEach(function(obj) {
                insts_IDs[obj.instituicoes_ID].push(obj)
            });

            state.results_unique = insts_IDs;

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

            commit('POPULATE_RESULTS', data)



        },
    },
}

const buffer_store = {
    namespaced : true,
    state: {
        buffering: Boolean,
    },
    mutations: {
        SET_BUFFER_TRUE(state){
           state.buffering = true;
        },
        SET_BUFFER_FALSE(state){
            state.buffering = false;
        },

    },
    getters: {
        status (state) {
            return state.buffering
        }
    },
    actions: {
        setBufferTrue({commit}){
            commit('SET_BUFFER_TRUE')
        },
        setBufferFalse({commit}){
            commit('SET_BUFFER_FALSE')
        },
    },
}

const user_store = {
    namespaced : true,
    state: {
        user: JSON
    },
    mutations: {
        SET_USER(state, user){
            state.user = user;
        },
    },
    getters: {
        user (state) {
            return state.user
        }
    },
    actions: {
        set_user({commit}, user){
            commit('SET_USER', user)
        },
    },
}

const message_store = {
    namespaced : true,
    state: {
        message: '',
        color: '',
        error: {
            color:'red',
            general: 'Algo correu mal. Por favor tente mais tarde ou contacte os administradores do website.',
            login: 'Combinação de senha e email não coincidem.',
            logout: 'Algo correu mal. O logout não foi executado com successo.',
            register: 'Algo correu mal. O registo não foi executado com successo.',
            fields: 'Verifique se os campos estão devidamente preenchidos',
            empty_response: 'Nenhum resultados retornados da pesquisa',
            email:{
                verification_sent: 'Não foi possível enviar um email de confirmação para o seu email. Porfavor tente mais tarde.'
            }

        },
        success:{
            color:'green',
            general: 'Sucesso.',
            email:{
                verification_sent: 'Foi enviado um email de verificação para o seu email. Por favor verifique a sua conta.'
            }
        },

    },
}

export default createStore({

  modules: {
      search_store,
      results_store,
      buffer_store,
      user_store,
      message_store

  }
})


