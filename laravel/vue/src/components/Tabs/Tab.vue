<template>
    <div @click="clicked" :class="this.react.show == true ? 'active' : ''">{{this.name }}</div>
</template>

<script>

import {reactive, ref} from "vue";


export default {
    name: "Tab",
    props:{
        name : '',
        content: '',
        active : Boolean
    },
    setup(props){
        let isTrueSet = (props.active === 'true');
        const react = reactive({'show' : isTrueSet})

      return{
          react
      }
    },
    mounted() {
        document.addEventListener('click', (e) => {
            if(!this.$el.contains(e.target)){
                this.react.show = false
            }
        });

        if(this.react.show == true){
            this.$emit('openTab', this.content)
        }


    },
    methods:{
        clicked(){
            this.react.show = true
            this.$emit('openTab', this.content)
        }
    }
}
</script>

<style scoped>
.active{
    text-decoration: underline;
}

div{
    color: white;
    cursor: pointer;
    text-decoration: none;
}
</style>
