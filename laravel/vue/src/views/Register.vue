<template>
    <div class="container">
        <form @submit.prevent="register">
            <label>Email</label>
            <input
                type="text"
                v-model="email"
                name="email"
                placeholder="Email..."
            >
            <span v-if="this.emailChecker(this.email)">O email tem que ser válido.</span>
            <label>Nome</label>
            <input
                type="text"
                v-model="nome"
                name="nome"
                placeholder="Nome..."
            >
            <label>Password</label>
            <input
                type="password"
                v-model="password"
                name="password"
                placeholder="Password..."
            >

            <label>Repetir password</label>
            <input
                type="password"
                v-model="password2"
                name="password"
                placeholder="Password..."
            />
            <span v-if="pass_check">As passwords devem corresponder</span>
            <br>

            <input type="submit" value="Registar"/>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Register",
    data() {
        return {
            email: '',
            password: '',
            password2: '',
            nome: '',
            pass_check : false,
            email_check : false,
        }
    },
    methods:{
        emailChecker(email){
            let val = String(email)
                .toLowerCase()
                .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
            this.email_check = !val;
            return !val;
        },
        EmailVerification(){
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
    },
    computed:{
        register(){

            if(this.email_check == true || this.pass_check == true){
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.fields
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                return
            }


            const params = new URLSearchParams();
            params.append('name', this.nome);
            params.append('email', this.email);
            params.append('password', this.password);
            params.append('password_confirmation', this.password2);

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/register`

            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            }).then( (res) => {
                sessionStorage.setItem('user', JSON.stringify(res.data))
                this.$store.state['user_store'].user = res.data

                this.EmailVerification()
            }).catch( (err) => {
                this.$store.state['buffer_store'].buffering = false
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.register
            } );
        },

    },
    watch: {
        password2(n, o) {

            if(n != this.password)
                this.pass_check=true
            else
                this.pass_check=false

        },
        email(n, o){

        }
    },
}
</script>

<style scoped>
* {box-sizing: border-box;}

.container {
    display: block;
    margin:auto;
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
    margin-top: 20px;
}

input[type=text], [type=email], [type=password], textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 30px;
}

input[type=submit]:hover {
    background-color: #45a049;
}

span {
    color: #ff4141;
    margin-top: -15px;
    text-align: left;
}
</style>
