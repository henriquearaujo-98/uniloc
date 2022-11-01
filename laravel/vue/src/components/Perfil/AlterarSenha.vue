<template>
<form @submit="submitForm">
    <label>Nova senha</label><br>
    <input type="text" v-model="this.data.nova_pw"><br>
    <input type="submit" value="Alterar senha">
</form>
</template>

<script>
import {reactive} from "vue";

export default {
    name: "AlterarSenha",
    setup(){
        return{
            data: reactive({
                nova_pw : ''
            })
        }
    },
    methods:{
        submitForm(e){

            e.preventDefault();

            console.log(this.data.nova_pw)
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
