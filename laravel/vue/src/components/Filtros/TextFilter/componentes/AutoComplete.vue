<template>
    <div v-show="this.$store.state[this.store_name].show">
        <ul>
            <li v-if="this.$store.state[this.store_name].options.length > 0" v-for="item in this.$store.state[this.store_name].options" :key="item.id" @click="select_item(item)">{{ item.nome }}</li>
            <li v-else>Sem opções correspondentes</li>
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
    methods:{
        dropdown(text){
            this.$store.dispatch(`${this.store_name}/get_dropdown`, text)[this.store_name]

        },
        select_item(item){
            this.$store.dispatch(`${this.store_name}/select_item`, item)[this.store_name]   // local store

            let info = {
                'item' : item,
                'where' : this.store_name
            }
            this.$store.dispatch(`search_store/add`, info)[this.store_name]    // search store for request
        }
    },
    watch: {
        text(val) { // nome do v-model
            this.dropdown(val)
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
    position: absolute;
    background: lightslategrey;
    z-index: 2;
    max-height: 400px;
    overflow: auto;
    width: 233px;
}
</style>
