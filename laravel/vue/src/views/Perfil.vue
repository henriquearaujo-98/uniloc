<template>
    <div class="container pr-8 pl-8" v-if="this.own">
        <h1>{{this.$store.state.user_store.user.user.name }}</h1>
        <div class="flex mt-6">
            <div class="flex-2 mr-10" style="height: auto; width: 300px; background-color: green">
                <Tab name = 'Perfil'
                     content = "perfil"
                     active=true
                     @open-tab="openTab"
                    />
                <Tab name = 'Informações pessoais'
                     content = "inf_pes"
                     active=false
                     @open-tab="openTab"
                />
                <Tab name = 'Alterar senha'
                     content = "inf_pes"
                     active=false
                     @open-tab="openTab"
                />
                <Tab name = 'Alterar email'
                     content = "inf_pes"
                     active=false
                     @open-tab="openTab"
                />
            </div>
            <div class="flex-1 p-8" style="height: auto; width: 75px; background-color: green; text-align: left">
                <div ref="perfil" class="tab-content">
                    Perfil aqui
                </div>
                <div ref="inf_pes" class="tab-content">
                    <InformacoesPessoais />
                </div>
            </div>
        </div>
    </div>

    <div class="container pr-8 pl-8" v-else>
        <h1>{{this.data.f_user.name }}</h1>
        <p v-if="this.data.f_user.curso_ID !== null && this.data.f_user.curso_ID !== undefined">{{this.data.f_user.curso.nome}}</p>
        <p v-if="this.data.f_user.instituicao_ID !== null && this.data.f_user.instituicao_ID !== undefined">{{this.data.f_user.instituicao.nome}}</p>
    </div>

</template>

<script>


import Tab from "@/components/Perfil/Tabs/Tab";
import {reactive, ref} from "vue";
import InformacoesPessoais from "@/components/Perfil/InformacoesPessoais";
import axios from "axios";

export default {
    name: "Perfil",
    components: {InformacoesPessoais, Tab},
    setup(){
      return{
        own: Boolean,
          data:reactive({f_user: {}})
      }
    },
    beforeCreate() {
        const userID = this.$route.query.userID
        if(userID == undefined){
            this.own = true
            this.name = this.$store.state.user_store.user.user.name

        }else{
            this.own = false

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/api/user/${userID}`

            this.$store.state['buffer_store'].buffering = true

            axios
            .get(url).then(res =>{
                this.data.f_user = res.data[0]
                console.log(this.data.f_user.name)
                console.log()
                this.$store.state['buffer_store'].buffering = false
            })
            .catch(err => {
                    this.$store.state['buffer_store'].buffering = false
                    if(err.response){
                        if(err.response.status === 404){
                            this.$router.push({name: '404'})
                        }else{
                            this.$store.state['message_store'].message = this.$store.state['message_store'].error.general
                            this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                        }
                    }else{
                        this.$store.state['message_store'].message = this.$store.state['message_store'].error.general
                        this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                    }
            });
        }


    },
    methods:{
        openTab(tab){
            const els = document.querySelectorAll('.tab-content');

            els.forEach(el => {
                el.style.display = 'none';
            });
            console.log(this.$refs[String(tab)].style.display = 'block')
        },
    }
}
</script>

<style scoped>
h1{
    color: white;
    font-size: 34px;
}

li{
    color: white;
    margin: 15px 0;
    cursor: pointer;
}

li.active{
    text-decoration: underline;
}

.tab-content{
    display: none;
}


</style>
