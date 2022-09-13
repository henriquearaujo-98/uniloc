<template>
    <div>
        <div class="loading">
            <img src="../assets/buffer.gif">
        </div>

    </div>
</template>

<script>
export default {
    name: "Buffer"
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

div h3{
    position: relative;
    top: 55vh;
    font-size: 38px;
}

</style>
