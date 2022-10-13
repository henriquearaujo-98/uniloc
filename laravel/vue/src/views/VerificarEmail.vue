<template>
    <h1 v-if="emailVerify">
        {{this.data.message}}
    </h1>
    <div v-else>
        <h1>O Email de confirmação foi enviado.</h1>
        <p>Ainda não recebeu o email de confirmação? Clique no butão abaixo para o re-enviar</p>
        <button @click="sendEmail">Reenviar</button>
    </div>
</template>

<script>
import axios from "axios";
import {reactive} from "vue";


export default {
    name: "VerificarEmail",
    setup(){
      return{
          data: reactive({message : ''}),
          emailVerify : false
      }
    },
    created() {
        if(this.$route.query.email_verify_url === undefined){
            this.emailVerify = false;
        }else{
            this.emailVerify = true;
        }
    },
    mounted() {

        if(this.emailVerify === false)
            return;

        const url = this.$route.query.email_verify_url
        const config = {
            headers: { Authorization: `Bearer ${this.$store.state.user_store.user.token.split('|')[1]}` }
        };

        axios.get(String(url), config)
            .then( (res) => {
            this.data.message = 'Email confirmado.';

            let user = JSON.parse(sessionStorage.getItem('user'));
            user.user.email_verified_at = Date.now();
            this.$store.state['user_store'].user.user.email_verified_at = Date.now()


        }).catch( (err) => {
            console.log(err);
            this.data.message = 'O email não pôde ser confirmado. Por favor tente de novo aqui';
        } );
    },
    methods:{
        sendEmail(){
            axios.post('http://localhost:3500/api/verification-notification', {}, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                    Authorization: `Bearer ${this.$store.state.user_store.user.token}`
                }
            }).then( (res) => {
                this.$store.state['message_store'].message = this.$store.state['message_store'].success.email.verification_sent
                this.$store.state['message_store'].color = this.$store.state['message_store'].success.color
                this.$router.push({name:'VerificarEmail'})
            }).catch( (err) => {
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.email.verification_sent
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
            } );
        }
    }
}
</script>

<style scoped>
h1{
    color: white;
}
</style>
