<template>
    Informações pessoais
    <form @submit="Save">
        <label>Nome</label><br>
        <input type="text" v-model="this.react.inf_pes.name"><br>

        <TextFilterOneOption label="Instituição"
                            :placeholder="this.inst"
                             localStorageItem="instituicoes"
                             @clicked="set_data"/>
        <TextFilterOneOption label="Curso"
                             :placeholder="this.curso"
                             localStorageItem="cursos"
                             @clicked="set_data"/>

        <input type="submit" value="Guardar">
    </form>
</template>

<script>

import {reactive} from "vue";
import TextFilterOneOption from "@/components/Perfil/TextFilterOneOption/TextFilterOneOption";
import axios from "axios";


export default {
    name: "InformacoesPessoais",
    components: {TextFilterOneOption},

    setup(){
        return{
            react : reactive({
                cursos : [],
                insts: [],
                inf_pes:{
                    name,
                    cursoID : '',
                    instID : ''
                },
            }),

            curso: '',
            inst: '',
            user : {},

        }
    },
    mounted() {
        this.user = this.$store.state.user_store.user

        if(this.user.user.name != null)
            this.react.inf_pes.name = this.user.user.name

        if(this.user.user.curso != null){
            this.react.inf_pes.cursoID = this.user.user.curso_ID
            this.curso = this.user.user.curso.nome
        }


        if(this.user.user.instituicao !== null){
            this.react.inf_pes.instID = this.user.user.instituicao_ID
            this.inst = this.user.user.instituicao.nome
        }


        this.react.cursos = JSON.parse(localStorage.getItem('cursos'))
        this.react.insts =  JSON.parse(localStorage.getItem('instituicoes'))

    },
    methods:{
        Save(e){
            e.preventDefault();
            this.$store.state.buffer_store.buffering = true

            let params = new URLSearchParams();


            params.append('name', this.react.inf_pes.name );

            params.append('instituicao_ID', this.react.inf_pes.instID );

            params.append('curso_ID', this.react.inf_pes.cursoID );


            const url = `${this.$store.state.networking_store.API_BASE_URL}/user/${this.$store.state.user_store.user.user.id}`


            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    Authorization: `Bearer ${this.user.token.split("|")[1]}`
                }
            }).then( (res) => {
                console.log(res)
                this.$store.state.user_store.user.user = res.data[0]

                let info = JSON.parse(sessionStorage.getItem('user'))
                info.user = res.data[0]
                sessionStorage.setItem('user', JSON.stringify(info))

                this.$store.state['message_store'].color = this.$store.state['message_store'].success.color
                this.$store.state['message_store'].message = this.$store.state['message_store'].success.changes
            }).catch( (err) => {
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.general
            } );

            this.$store.state.buffer_store.buffering = false

        },
        set_data(data){
            switch (data.LS){
                case 'instituicoes': this.react.inf_pes.instID = data.item.ID; break;
                case 'cursos': this.react.inf_pes.cursoID = data.item.ID; break;
            }
        }
    }
}
</script>

<style scoped>

input[type=button], input[type=submit], input[type=reset] {
    background-color: #04AA6D;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
