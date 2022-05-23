<template>
    <div>
        <a href="#">
            <img src="../assets/logo-full.png">
        </a>
    </div>
</template>

<script>
export default {
    name: "Logo",
}
</script>

<style scoped>
img{
    width: 250px;
    height: auto;
}
div{
    display: flex;
    justify-content: center; /* align horizontal */
    align-items: center; /* align vertical */
}
</style>
