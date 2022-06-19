<template>
    <div class="inline overflow-x-scroll flex-1" style="position: relative; height: 50px; max-width: 200px">

        <span v-if="this.$store.state[this.store_name].selected.length > 0" v-for="item in this.$store.state[this.store_name].selected" :key="item.id" @click="remove_item(item)" class="mr-3">
            {{item.nome}}
        </span>
        <span v-else>
            Todos
        </span>
    </div>
</template>

<script>
export default {
    name: "ResultsArea",
    props:{
        store_name: String
    },
    methods:{
        remove_item(item){
            this.$store.dispatch(`${this.store_name}/remove_item`, item)[this.store_name]

            let info = {
                'item' : item,
                'where' : this.store_name
            }
            this.$store.dispatch(`search_store/remove`, info)[this.store_name]    // search store for request

        }
    }
}
</script>

<style scoped>
span{
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    border-radius: 15px;
    background: dimgrey;
    padding: 5px 10px;
}

span:hover{
    cursor: pointer;
    background: darkgrey;
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
    background: #b30000;
}
</style>
