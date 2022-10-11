<template>
    <ul  v-if="this.data.options.length > 0 && this.data.show">
        <li v-for="item in this.data.options" :key="item.id" @click="clicked(item)">{{ item.nome }}</li>
    </ul>
</template>

<script>
import {reactive} from "vue";

export default {
    name: "Options",
    props:{
        text: '',
        LSI : String
    },
    setup(){
        return{
            list : [],
            data : reactive({
                options: [],
                show: false
            })
        }
    },
    mounted() {
        this.list = JSON.parse(localStorage.getItem(this.LSI))

        document.addEventListener('click', (e) => {
            if(!this.$el.contains(e.target)){
                this.data.show = false
            }else{
                this.data.show = true
            }
        });
    },
    methods:{
      clicked(item){
          this.data.show = false
          this.$emit('clicked', {LS: this.LSI, item: item})
      }
    },
    watch: {
        text(val) { // nome do v-model

            this.data.options = []

            this.list.forEach(element => {
                if (element.nome.toUpperCase().indexOf(this.text.toUpperCase()) !== -1) {
                    this.data.options.push(element)
                }
            })

            if(this.data.options.length === this.list.length)
                this.data.show = false

            if(this.data.options.length > 0)
                this.data.show = true
            else
                this.data.show = false


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

    background-color: lightslategrey;
    max-height: 450px;
    overflow: auto;
    width: auto;
    border-radius: 0 0 10px 10px;
    margin-top: 0px;
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
