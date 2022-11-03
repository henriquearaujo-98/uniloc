<template>
    <div class="container">
        <form @submit.prevent="login">
            <label>Email</label>
            <input
                type="text"
                v-model="email"
                name="email"
                placeholder="Email..."
            >
            <label>Password</label>
            <input
                type="password"
                v-model="password"
                name="password"
                placeholder="Password..."
            >

            <input type="checkbox" v-model="remember_me">

            <p>
                 <router-link class="link" to="/pw_reset">Esqueceu-se da password?</router-link>.
            </p>

            <input type="submit" value="Login"/>
        </form>
    </div>
    <p>
        Ainda não tens conta? Cria a tua <router-link class="link" to="/register">aqui</router-link>.
    </p>
</template>

<script>
import axios from "axios";
export default {
    name: "Login",
    data() {
        return {
            email: '',
            password: '',
            remember_me: 'false'
        }
    },
    methods:{
        login(){
            console.log(this.remember_me);

            if(this.email === ''){
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.fields
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                return;
            }

            if(this.password === ''){
                this.$store.state['message_store'].message = this.$store.state['message_store'].error.fields
                this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                return;
            }

            this.$store.state['buffer_store'].buffering = true

            const params = new URLSearchParams();
            params.append('email', this.email);
            params.append('password', this.password);
            params.append('remember_me', String(this.remember_me));

            const url = `${this.$store.state['networking_store'].API_BASE_URL}/login`

            axios.post(url, params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            }).then( (res) => {
                localStorage.setItem('user', JSON.stringify(res.data))
                this.$store.state['user_store'].user = res.data
                console.log(this.$store.state['user_store'].user.user)
                this.$store.state['buffer_store'].buffering = false
                this.$router.push('/')
            }).catch( (err) => {
                this.$store.state['buffer_store'].buffering = false

                if(err.response.status == 401){
                    this.$store.state['message_store'].color = this.$store.state['message_store'].error.color
                    this.$store.state['message_store'].message = this.$store.state['message_store'].error.login
                }



            });
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
