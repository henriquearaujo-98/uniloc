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
        }
    },
    methods:{
        login(){
            console.log('logging in')
            if(this.email == ''){
                this.$store.state['buffer_store'].message = 'Email must not be empty'
                this.$store.state['buffer_store'].color = 'red'
                return;
            }

            if(this.password == ''){
                this.$store.state['buffer_store'].message = 'Password must be set'
                this.$store.state['buffer_store'].color = 'blue'
                return;
            }

            this.$store.state['buffer_store'].buffering = true

            const params = new URLSearchParams();
            params.append('email', this.email);
            params.append('password', this.password);
            axios.post('http://localhost:3500/api/login', params, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            }).then( (res) => {
                sessionStorage.setItem('user', JSON.stringify(res.data))
                this.$store.state['user_store'].user = res.data
                console.log(this.$store.state['user_store'].user.user)
                this.$store.state['buffer_store'].buffering = false
            }).catch( (err) => {
                console.log(err);
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
