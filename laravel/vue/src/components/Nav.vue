<template>
    <nav>
        <div class="hidden sm:flex">
            <router-link v-for="item in this.links" :key="item.name" :to="item.href">{{ item.name }}</router-link>
            <span v-if=" this.$store.state.user_store.user.user != null">
                <router-link  key="Profile" to="/profile">{{ this.$store.state.user_store.user.user.name }}</router-link>
                <a @click="this.logout">Logout</a>
            </span>

            <router-link v-else key="Login" to="/login">Login</router-link>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
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
        console.log(this.$store.state.user_store.user )
         if(this.$store.state.user_store.user != '')
             this.$store.state.user_store.user = JSON.parse(this.$store.state.user_store.user)

    },
    components:{},
    computed:{
        logout(){
            console.log('logging out ' + this.$store.state.user_store.user.token);
            const config = {
                headers: { Authorization: `Bearer ${this.$store.state.user_store.user.token}` }
            };

            const bodyParameters = {
            };

            axios.post(
                'http://localhost:3500/api/logout',
                bodyParameters,
                config
            ).then(()=>{
                this.$store.state.user_store.user = {}
                sessionStorage.setItem('user', '');
                console.log('logged out')
            }).catch(console.log);

        }
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
