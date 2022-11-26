<template>
<form @submit="submitForm">
    <label>Senha atual</label><br>
    <input type="password" v-model="this.data.old_pw"><br>
    <label>Nova senha</label><br>
    <input type="password" v-model="this.data.nova_pw"><br>
    <label>Repetir senha</label><br>
    <input type="password" v-model="this.data.nova_pw2"><br>
    <p v-show="this.data.nova_pw != this.data.nova_pw2" style="color:red">As senhas devem ser iguais</p>
    <input type="submit" value="Alterar senha">

</form>
</template>

<script>
import {reactive} from "vue";
import axios from "axios";

export default {
    name: "AlterarSenha",
    setup(){
        return{
            data: reactive({
                nova_pw : '',
                nova_pw2 : '',
                old_pw : ''
            })
        }
    },
    methods:{
        submitForm(e) {

            e.preventDefault();

            if (this.data.nova_pw != this.data.nova_pw2)
                return;

            const params = new URLSearchParams();
            params.append('old_password', this.data.old_pw);
            params.append('new_password', this.data.nova_pw);
            params.append('new_password_confirmation', this.data.nova_pw2);

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/change-password`
            console.log(String(this.$store.state.user_store.user.token).split('|')[1]);
            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                    Authorization: `Bearer ${String(this.$store.state.user_store.user.token).split('|')[1]}`
                }
            }).then((res) => {
                this.$store.state['message_store'].color = this.$store.state['message_store'].success.color
                this.$store.state['message_store'].message = "Senha alterada com sucesso.";
            }).catch((err) => {
                this.$store.state['buffer_store'].buffering = false

                if (err.response.status === 401) {
                    this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                    this.$store.state['message_store'].message = "Não foi possível realizar a operação. Verifique o campo para a senha atual.";
                }
            });
        }
    }
}
</script>

<style scoped>
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
