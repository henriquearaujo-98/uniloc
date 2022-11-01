<template>

    <div class="container">
        <h1>Pesquisar conta</h1>
        <form @submit.prevent="pesquisar">
            <label>Email</label>
            <input
                type="text"
                v-model="data.email"
                name="email"
                placeholder="Email..."
            >

            <input type="submit" value="Redifinir"/>
        </form>
    </div>

</template>

<script>
import {reactive} from "vue";
import axios from "axios";

export default {
    name: "PesquisarConta",
    setup(){
      return{
          data: reactive({
              email : ''
          })
      }
    },
    methods:{
        emailCheck(email){
            return String(email)
                .toLowerCase()
                .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
        },
        pesquisar(){

            if(!this.emailCheck(this.data.email)){
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.field.email
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                return
            }

            const params = new URLSearchParams();
            params.append('email',this.data.email);

            this.$store.state['buffer_store'].buffering = true

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/forgot-password`

            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            }).then( (res) => {
                this.$store.state['buffer_store'].buffering = false
                this.$emit("searched", this.data.email)

            }).catch( (err) => {
                this.$store.state['buffer_store'].buffering = false
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color

                if(err.response.status === 404){
                    this.$store.state['message_store'].message = this.$store.state['message_store'].error.email.not_found
                    return
                }

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
