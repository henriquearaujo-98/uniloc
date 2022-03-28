<template>
<div class="marker">
    <div class="rank"><small>#{{this.rank}}</small></div>
    <div class="inst">{{ this.inst }}</div>
    <div class="nota">{{ this.nota }}</div>
</div>
</template>

<script>

export default {
    name: "Marker",
    props:{
        item : Object
    },
    setup(){

        const rank =  1
        const inst = 'IPB'
        const nota = '15,6'

        return {
          rank ,
          inst ,
          nota ,
        }
    },
    mounted() {
        this.rank = 1
        this.inst = 'IPB'
        this.nota = '10,6'
    }
}
</script>

<style scoped>

.marker {
    width: 60px;
    height: 80px;
    position:relative;
    z-index:0;
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
}



</style>
