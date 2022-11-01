<template>
    <div class="container">
        <h1>Confirmar Codigo</h1>
        <form @submit.prevent="confirmar">
            <label>Código</label>
            <input
                type="text"
                v-model="data.codigo"
                placeholder="Insere o código..."
            >

            <input type="submit" value="Redifinir"/>
        </form>
    </div>
</template>

<script>
import {reactive} from "vue";
import axios from "axios";

export default {
    name: "ConfirmarCodigo",
    props:{
        email : String
    },
    setup(){
        return{
            data: reactive({codigo: ''})
        }
    },
    methods:{
        confirmar(){

            if(!this.data.codigo){
                this.$store.state['message_store'].message = "Por favor insira o código que enviamos para o seu email."
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                return
            }

            const params = new URLSearchParams();
            params.append('email',this.$props.email);
            params.append('token',this.data.codigo);

            this.$store.state['buffer_store'].buffering = true

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/check-reset-token`

            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            }).then( (res) => {
                this.$store.state['buffer_store'].buffering = false

                if(res){
                    this.$emit("confirmed", this.data.codigo)
                    return
                }

                this.$store.state['message_store'].message = "O código que inseriu não é válido. Confirma que inseriu o código corretamente."
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color

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
