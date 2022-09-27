<template>
    <nav>
        <div class="hidden sm:flex">
            <router-link v-for="item in this.links" :key="item.name" :to="item.href">{{ item.name }}</router-link>
        </div>
    </nav>
</template>

<script>
const links = [
    {
        'name': 'Sobre',
        'href': '/sobre'
    },
    {
        'name': 'Contacto',
        'href': '/contacto'
    },
    {
        'name': 'Login',
        'href': '/login'
    }
]

export default {
    name: "Nav",
    setup(){
        return{
            links
        }
    },
    components:{}
}
</script>

<style scoped>
a{
    color:white;
    font-size: 24px;
    margin-right: 25px;
    align-items: center;
    cursor: pointer;

}

nav{
    margin-left: auto;
    display: flex;
    justify-content: center; /* align horizontal */
    align-items: center; /* align vertical */
}
</style>
