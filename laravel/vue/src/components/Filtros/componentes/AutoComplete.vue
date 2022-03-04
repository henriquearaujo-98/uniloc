<template>
    <div style="background: lightslategrey">
        <ul>
            <li v-for="item in options" :key="item.id" @click="select_item(item)">{{ item.nome }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "AutoComplete",
    props:{
        pool : Array,
        text: String
    },
    data(){
        return {
            selected : Array,
            options: [] // opções cujo texto selecionado corresponde á pool de informação
        }
    },
    methods:{
        get_like(text){

            if(text === ''){
                this.options = [];
                return;
            }

            this.options = this.pool.filter(element => {
                if (element.nome.indexOf(text) !== -1) {
                    return true;
                }
            })

        },
        select_item(item){
            this.$emit('select-item', item);
            this.options.pop(item)
        }
    },
    watch: {
        text(val) { // nome do v-model
            console.log(val)
            this.get_like(val)
        }
    }
}
</script>

<style scoped>
li:hover{
    cursor: pointer;
    background: dimgrey;
}
</style>
