<template>
    <div style="background: lightslategrey">
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
        get_like(text){

            /*if(text === ''){
                this.$store.state[this.store_name].options = [];
                return;
            }

            let temp = [];
            this.$store.state[this.store_name].pool.forEach(element => {        // Get a selection from pool that has substring text and is not present in the selected array
                if (element.nome.toUpperCase().indexOf(text.toUpperCase()) !== -1) {
                    if(this.$store.state[this.store_name].selected.length){
                        this.$store.state[this.store_name].selected.forEach(item => {
                            if(item != element)
                                temp.push(element)
                        })
                    }else{
                        temp.push(element)
                    }
                }
            })

            this.$store.state[this.store_name].options = temp;*/

            this.$store.dispatch('get_dropdown', text)[this.tabela]

        },
        select_item(item){
            /*this.$store.state[this.store_name].selected.push(item)
            this.$store.state[this.store_name].options.splice(this.$store.state[this.store_name].options.indexOf(item),1)*/
            this.$store.dispatch('select_item', item)[this.tabela]
        }
    },
    watch: {
        text(val) { // nome do v-model
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
