<template>
    <div class="container pr-8 pl-8">
        <h1>{{this.name}}</h1>
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
                    Informações pessoais
                    <form @submit="inf_pes">
                        <label>Nome</label><br>
                        <input type="text" :placeholder="this.name" v-model="this.inf_pes.name"><br>
                        <input type="submit" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


import Tab from "@/components/Tabs/Tab";
import {ref} from "vue";
export default {
    name: "Perfil",
    components: {Tab},
    setup(){
      return{
        name : '',
        inf_pes: {
            name : ''
        },
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
            e.preventDefault();
            if(this.inf_pes.name == this.name){
                this.$store.state['buffer_store'].message = 'Nada a mudar'
                this.$store.state['buffer_store'].color = 'yellow'
                return;
            }


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
