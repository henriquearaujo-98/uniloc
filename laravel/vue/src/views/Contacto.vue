<template>
    <div class="container">
        <form @submit="sendEmail">
            <label>Nome</label>
            <input
                type="text"
                v-model="name"
                name="name"
                placeholder="Nome..."
            >
            <label>E-mail</label>
            <input
                type="email"
                v-model="email"
                name="email"
                placeholder="E-mail..."
            >
            <label>Assunto</label>
            <input
                type="text"
                v-model="assunto"
                name="assunto"
                placeholder="Assunto..."
            >
            <label>Mensagem</label>
            <textarea
                name="message"
                v-model="message"
                cols="30" rows="5"
                placeholder="Mensagem...">
            </textarea>

            <input type="submit" value="Enviar"/>
        </form>
    </div>
</template>


<script>
import emailjs from 'emailjs-com';

export default {
    name: 'Contacto',
    data() {
        return {
            name: '',
            email: '',
            assunto: '',
            message: ''
        }
    },
    methods: {
        sendEmail(e) {
            try {
                emailjs.send('service_xvs9ekg', 'template_taw7gcb', {
                        name: this.name,
                        email: this.email,
                        assunto: this.assunto,
                        message: this.message
                    });
            } catch (error) {
                console.log({error})
            }
            // Reset form field
            this.name = ''
            this.email = ''
            this.assunto = ''
            this.message = ''
        },
    }
}
</script>

<style scoped>
* {box-sizing: border-box;}

.container {
    display: block;
    margin:auto;
    text-align: center;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    width: 50%;
}

label {
    float: left;
}

input[type=text], [type=email], textarea {
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
</style>
