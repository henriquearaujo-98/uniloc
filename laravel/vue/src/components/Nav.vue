<template>
    <nav>
        <div class="hidden sm:flex">
            <router-link v-for="item in this.links" :key="item.name" :to="item.href">{{ item.name }}</router-link>
            <span v-if=" this.$store.state.user_store.user.user != null">
                <router-link  key="Perfil" to="/perfil">{{ this.$store.state.user_store.user.user.name }}</router-link>
                <a @click="this.logout">Logout</a>
            </span>

            <router-link v-else key="Login" to="/login">Login</router-link>
        </div>
    </nav>


    <Buffer v-if="this.$store.state['buffer_store'].buffering == true"/>
</template>

<script>
import axios from "axios";
import Madeira from "@/components/Madeira";
import Acores from "@/components/Acores";
import FilterForm from "@/components/FilterForm";
import Mapa from "@/components/Mapa";
import Buffer from "@/components/Buffer";

const links = [
    {
        'name': 'Sobre',
        'href': '/sobre'
    },
    {
        'name': 'Contacto',
        'href': '/contacto'
    },

]



export default {
    name: "Nav",
    setup(){
        return{
            links,

        }
    },
    created() {

        function testJSON(text) {
            if (typeof text !== "string") {
                return false;
            }
            try {
                JSON.parse(text);
                return true;
            } catch (error) {
                return false;
            }
        }

        if(testJSON(this.$store.state.user_store.user))
             this.$store.state.user_store.user = JSON.parse(this.$store.state.user_store.user)

    },
    components:{Buffer},
    computed:{
        logout(){
            console.log('logging out ' + this.$store.state.user_store.user.token);
            const config = {
                headers: { Authorization: `Bearer ${this.$store.state.user_store.user.token}` }
            };

            const bodyParameters = {
            };

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/logout`

            this.$store.state['buffer_store'].buffering = true

            axios.post(
                url,
                bodyParameters,
                config
            ).then(()=>{
                this.$store.state.user_store.user = {}
                sessionStorage.setItem('user', '');
                this.$store.state['buffer_store'].buffering = false

                this.$router.push({name:'home'})

            }).catch(err => {

                this.$store.state['buffer_store'].buffering = false
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.logout
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color

            });


        },
    }
}
</script>

<style scoped>
a{
    color:white;
    font-size: 24px;
    margin-right: 25px;
    align-items: center;
    cursor: pointer;

}

nav{
    margin-left: auto;
    display: flex;
    justify-content: center; /* align horizontal */
    align-items: center; /* align vertical */
}
</style>
