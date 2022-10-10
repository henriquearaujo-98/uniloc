<template>
    <div style="width: 100%;">
        <label>{{this.label}}</label><br>
        <input type="text" v-model="this.data.txt" ref="input" style="width: 100%" >
        <Options :text="this.data.txt" :LSI=this.localStorageItem @clicked="selected"  />

    </div>
</template>

<script>

import {reactive} from "vue";
import Options from "@/components/Perfil/TextFilterOneOption/Options";

export default {
    name: "TextFilterOneOption",
    components: {Options},
    props:{
        label: String,
        placeholder: String,
        localStorageItem : String
    },
    setup(){
        return{
            data : reactive({
                txt : '',
            })
        }
    },
    mounted() {
        setTimeout(()=>{
            this.data.txt = this.placeholder
        },0)


    },
    methods:{
        selected(data){
            this.$refs.input.value = data.item.nome
            this.$emit("clicked", data)
        }
    }


}
</script>

<style scoped>

</style>
