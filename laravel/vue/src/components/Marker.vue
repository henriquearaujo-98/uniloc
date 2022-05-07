<template>
<div class="marker" @mouseenter="this.state.hover = true" @mouseleave="this.state.hover = false">
    <div class="rank" v-show="this.item.rank"><small>#{{this.item.rank}}</small></div>
    <div class="inst">{{ this.state.sigla }}</div>
    <div class="nota">{{ this.item.nota_ult_1fase ? this.item.nota_ult_1fase : this.item.nota_ult_2fase }}</div>
    <div class="hover_obj" v-show="this.state.hover">
        <ul v-for="item in this.cursos">
            <li>{{item.curso[0].nome}}</li>
        </ul>
    </div>
</div>

</template>

<script>
import { reactive } from 'vue'
export default {
    name: "Marker",
    props:{
        item : Object,
        inst : String,
        rank: ''
    },
    setup(){
        const state = reactive({sigla: false, hover : false})
        let cursos = []
        return{
            state,
            cursos,

        }
    },
    mounted() {



        if(this.item.nota_ult_1fase == 'Informação não disponível'){
            this.item.nota_ult_1fase = 'ND'
        }

        this.$store.state['results_store'].results.forEach(i => {
            if(i.instituicoes_ID == this.item.instituicoes_ID)
                this.cursos.push(i);
        })

        if(this.cursos.length > 1){
            this.item.nota_ult_1fase = ''
            this.item.nota_ult_2fase = ''
        }

        this.state.escola = this.inst.split('-')[1]
        const temp_inst = this.inst.split('-')[0]

         this.state.sigla = temp_inst.split(/\s/)
            .reduce((accumulator, word) => accumulator + word.charAt(0), '');

         this.state.sigla = this.state.sigla.replace( /[^A-Z]/g, '' );
        //console.log(this.state.sigla + " - " + this.inst)
    },
}
</script>

<style scoped>

.hover_obj{
    background: black;
    width: 300px;
    max-height: 300px;
    position: relative;
    z-index: 1;
    transform: translate(50px, -120px);
    overflow: scroll;
}

.marker {
    width: 50px;
    height: 80px;
    transform: translate(0, -80px);
    z-index:0;
    display: block;
}
.marker::before {
    content:"";
    position:absolute;
    transform: rotate(180deg);
    z-index:-1;
    top:0;
    left:0;
    right:0;
    bottom:0;
    clip-path: polygon(50% 0%, 100% 20%, 100% 100%, 0 100%, 0 20%);
    background-color: orangered;
}

.rank{
    width: 100%;
    height: 10px;
    background: gold;
}
.rank small{
    position: relative;
    top: -6px;
    color: black;
}

.inst{
    background: #2c3e50;
    padding: 5px 0 5px 0;
    overflow: hidden;
    text-overflow: ellipsis;
}



</style>
