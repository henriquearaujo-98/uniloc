<template>
    <div>
        <input type="text" name="text" autocomplete="off" v-model="text" style="color: black" class="mr-5" @focusin="toggle_dropdown">

        <svg xmlns="http://www.w3.org/2000/svg" :class="[this.local_show ? 'rotate' : '', 'h-6 w-6']" @click="toggle_dropdown" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>

        <AutoComplete :store_name="store_name" :text="text" />
    </div>
</template>

<script>
import AutoComplete from "@/components/Filtros/componentes/AutoComplete";

export default {

    name: "TextInput",
    components: {AutoComplete},
    props:{
        store_name: String
    },
    data(){
        return{
            text : '',
            local_show : false
        }
    },
    mounted() {
        // Watch api
        this.$store.watch(()=> this.$store.state[this.store_name].show,
            value => {
                this.local_show = value
            },
            {
                deep : true
            })
    },
    methods:{
        dropdown(){
            this.$store.dispatch(`${this.store_name}/get_dropdown`, '')[this.tabela]
        },
        toggle_dropdown(){

            this.$store.state[this.store_name].show = !this.local_show

            if(this.$store.state[this.store_name].options){ // Se o utilizador ainda não clicou no input para obter o dropdown, também pode faze-lo atraves da seta
                this.dropdown()
            }

            // watch no state.show
            // animar a seta quando tiver a mostrar
            // ao clicar na seta, show = false
            // ao clicar na seta show = true e mostrar tudo

        }
    },

}
</script>

<style scoped>
input{
    position: relative;
    padding-right: 25px;
}

svg:hover{
    cursor: pointer;
}

svg{
    display: inline;
    position: relative;
    right: 50px;
    color: black;
    transition: 0.5s;
}

.rotate{
    transform: rotate(90deg);
}
</style>
