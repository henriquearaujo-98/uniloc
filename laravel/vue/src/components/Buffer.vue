<template>
    <div>
        <div class="loading">
            <h3>{{message}}</h3>
            <img src="../assets/buffer.gif">
        </div>

    </div>
</template>

<script>
export default {
    name: "Buffer",

    computed:{
        message(){
            return this.$store.state['buffer_store'].message
        }
    },
    watch: {
        message(n, o){
            this.message = n;
        }
    }
}
</script>

<style scoped>
div{
    width: 100%;
    height: 100%;
    top:0;
    left: 0;
    background: rgba(110, 110, 110,0.5);

    position: fixed;
    z-index: 999;
}

.loading{
    width: 100%;
    height: auto;
    margin: 25%;
    background: transparent;
}

.loading img{
    transform: translate(-9%, 0);
}

div h3{
    position: relative;
    top: 50%;
    transform: translate(-25%, 0);
    font-size: 38px;
    color: white;
}

</style>
