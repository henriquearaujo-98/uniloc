<template>

    <PesquisarConta @searched="searched"
                    v-if="this.data.step === 1"/>

    <ConfirmarCodigo :email="this.data.email"
                     @confirmed="confirmed"
                     v-if="this.data.step === 2"/>

    <RedefinirSenha :email="this.data.email"
                    :token="this.data.token"
                    v-if="this.data.step === 3"/>

</template>

<script>
import PesquisarConta from "@/components/PasswordReset/PesquisarConta";
import ConfirmarCodigo from "@/components/PasswordReset/ConfirmarCodigo";

import {reactive} from "vue";
import RedefinirSenha from "@/components/PasswordReset/RedefinirSenha";
export default {
    name: "PassowrdReset",
    components: {RedefinirSenha, ConfirmarCodigo, PesquisarConta},
    setup(){
        return{
            data: reactive({
                step: 1,
                email: '',
                token: '',
                password: ''
            })
        }
    },
    methods:{
        searched(email){
            this.data.email = email
            this.data.step = 2
        },
        confirmed(token){
            this.data.token = token
            this.data.step = 3
        }
    }
}
</script>

<style scoped>

</style>
