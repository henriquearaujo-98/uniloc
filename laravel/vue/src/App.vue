<template>
    <!-- Load required Bootstrap and BootstrapVue CSS -->
<!--    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css" />-->
<!--    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />-->

    <Header />
    <Message />

  <router-view/>

    <Footer />
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background: #2c3e50;
  text-align: center;
}

</style>
<script>

import Header from "@/components/Header";
import Footer from "@/components/Footer";
import Message from "@/components/Message";
import axios from "axios";
export default {
    components: {Footer, Header, Message},
    created() {
        // Local cache

        /// Filtros
        if(!localStorage.hasOwnProperty('filtros')){

           this.resetFiltros()

        }else{
            let filtros = JSON.parse(localStorage.getItem('filtros'))

            const last_updated = Date.parse(filtros.last_updated)
            const now = new Date()
            const diffTime = Math.abs(now - last_updated); // milliseconds
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if(diffDays > 1 || last_updated === null){
                this.resetFiltros()

            }

            console.log(diffDays)

        }


        /// User
        if(localStorage.getItem('user') != null){
            let user = JSON.parse(localStorage.getItem('user'))

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/check-token`

            const params = new URLSearchParams();
            params.append('token', user.token);

            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                    Authorization: `Bearer ${user.user.token}`
                }
            }).then( (res) => {

                localStorage.setItem('user', JSON.stringify(res.data))
                this.$store.state['user_store'].user = res.data

            }).catch( (err) => {
                localStorage.removeItem('user')
                this.$store.state['user_store'].user = []

                if(err.response.status === 401)
                    return

                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.general

            });

            this.$store.state['user_store'].user = localStorage.getItem('user');
        }
    },
    beforeUnmount() {

       /* if(localStorage.getItem('user') != null){
            let user = JSON.parse(localStorage.getItem('user'))
            if(user.remember_me === 'false')
                localStorage.removeItem('user')
        }*/

    },
    methods:{
        resetFiltros(){
            const filtros = {
                last_updated : new Date(),
                distritos: {},
                municipios: {},
                instituicoes: {},
                area_estudo: {},
                cursos: {},
                tipos_ensino: {},
                exames: {},
            }

            localStorage.setItem('filtros', JSON.stringify(filtros))
        },
    }
}
</script>
