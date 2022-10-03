<template>
    <h1>
        {{message}}
    </h1>
</template>

<script>
import axios from "axios";


export default {
    name: "VerificarEmail",
    setup(){
      return{
          message: String
      }
    },
    mounted() {
        const url = this.$route.query.email_verify_url
        const config = {
            headers: { Authorization: `Bearer ${this.$store.state.user_store.user.token.split('|')[1]}` }
        };

        axios.get(String(url), config)
            .then( (res) => {
            this.message = 'Email confirmado';
            console.log('sucess')
        }).catch( (err) => {
            console.log(err);
            this.message = 'Algo correu mal';
        } );
    }
}
</script>

<style scoped>
h1{
    color: white;
}
</style>
