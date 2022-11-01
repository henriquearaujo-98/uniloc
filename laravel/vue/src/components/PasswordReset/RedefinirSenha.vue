<template>
    <div class="container">
        <h1>Redefinir Senha</h1>
        <form @submit.prevent="redefinir">
            <label>Senha</label>
            <input
                type="password"
                v-model="data.password"
                placeholder="Insere a nova senha..."
            >

            <input type="submit" value="Redifinir"/>
        </form>
    </div>
</template>

<script>
import {reactive} from "vue";
import axios from "axios";

export default {
    name: "RedefinirSenha",
    props:{
        email : String,
        token : String
    },
    setup(){
        return{
            data :  reactive({
                password: ''
            })
        }
    },
    methods:{
        redefinir(){

            if(this.data.password === ''){
                this.$store.state['message_store'].message = "Por favor insira uma nova senha."
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                return
            }

            const params = new URLSearchParams();
            params.append('email',this.$props.email);
            params.append('token',this.$props.token);
            params.append('password',this.data.password);


            this.$store.state['buffer_store'].buffering = true

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/reset-password`

            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            }).then( (res) => {
                this.$store.state['buffer_store'].buffering = false
                this.$store.state['message_store'].message = "A sua senha foi reposta com sucesso."
                this.$store.state['message_store'].color = this.$store.state['message_store'].success.color

                this.$router.push('/login')

            }).catch( (err) => {

                this.$store.state['buffer_store'].buffering = false
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color

                this.$store.state['message_store'].message = this.$store.state['message_store'].error.general

            } );
        }
    }


}
</script>

<style scoped>
* {box-sizing: border-box;}

.container {
    display: block;
    margin:auto;
    height: 100%;
    text-align: center;
    border-radius: 5px;
    background-color: #465773;
    padding: 20px;
    width: 50%;
    border: 1px solid lightgrey;
}

label {
    float: left;
    color: white;
}

input[type=text], [type=email], [type=password], textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
    color: black;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

p {
    color: white;
    margin-top: 20px;
}

.link{
    cursor: pointer;
    text-decoration: underline;
}
</style>
