<template>
    <div v-show="this.$store.state[this.store_name].show">
        <ul>
            <li v-for="item in this.$store.state[this.store_name].options" :key="item.id" @click="select_item(item)">{{ item.nome }}</li>
        </ul>
    </div>
</template>

<script>

export default {
    name: "AutoComplete",
    props:{
        store_name: String,
        text: String
    },
    data(){
        return {
            selected : Array,
            options: [] // opções cujo texto selecionado corresponde á pool de informação
        }
    },
    methods:{
        dropdown(text){
            this.$store.dispatch(`${this.store_name}/get_dropdown`, text)[this.store_name]

        },
        select_item(item){
            this.$store.dispatch(`${this.store_name}/select_item`, item)[this.store_name]
        }
    },
    watch: {
        text(val) { // nome do v-model
            this.dropdown(val)
            console.log(this.$store.state[this.store_name].show)
        }
    }
}
</script>

<style scoped>
li:hover{
    cursor: pointer;
    background: dimgrey;
}
ul{
    position: relative;
    background: lightslategrey;
    z-index: 2;
    max-height: 400px;
    overflow: auto;
}
</style>
