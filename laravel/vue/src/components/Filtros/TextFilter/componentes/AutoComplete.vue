<template>
    <div v-show="this.$store.state[this.store_name].show" class="dropdown" :id="this.store_name">
        <div class="bufferzone"></div>
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
.bufferzone{
    position: relative;
    top: -15px;
    background-color: lightslategrey;
    width: 233px;
    height: 20px;
    z-index: 0;
}
li:hover{
    cursor: pointer;
    background: dimgrey;
}
ul{
    position: absolute;
    background-color: lightslategrey;
    max-height: 450px;
    overflow: auto;
    width: 233px;
    border-radius: 0 0 10px 10px;
    margin-top: -15px;
    z-index: 4;
    padding-bottom: 15px;
}

/* width */
::-webkit-scrollbar {
    width: 10px;
    height: 5px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px transparent;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #506a8f;
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #a9a9a9;
}
</style>
