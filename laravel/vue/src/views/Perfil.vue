<template>
    <div class="container pr-8 pl-8">
        <h1>{{this.$store.state.user_store.user.user.name }}</h1>
        <div class="flex mt-6">
            <div class="flex-2 mr-10" style="height: auto; width: 300px; background-color: green">
                <Tab name = 'Perfil'
                     content = "perfil"
                     active=false
                     @open-tab="openTab"
                    />
                <Tab name = 'Informações pessoais'
                     content = "inf_pes"
                     active=true
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

</template>

<script>


import Tab from "@/components/Perfil/Tabs/Tab";
import {ref} from "vue";
import InformacoesPessoais from "@/components/Perfil/InformacoesPessoais";

export default {
    name: "Perfil",
    components: {InformacoesPessoais, Tab},
    setup(){
      return{
        own: Boolean
      }
    },
    beforeCreate() {
        const userID = this.$route.query.userID
        if(userID == undefined){
            this.own = true
            this.name = this.$store.state.user_store.user.user.name
            console.log(this.$store.state.user_store.user.user.name)
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
        inf_pes(e){



        }
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
