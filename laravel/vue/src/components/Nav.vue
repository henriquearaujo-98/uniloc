<template>
    <nav>
        <div class="hidden sm:flex">
            <a v-for="item in this.links" :key="item.name" :href="item.href">{{ item.name }}</a>
        </div>
        <div class="sm:hidden relative">
            <MenuIcon />
        </div>
    </nav>
</template>

<script>
import { MenuIcon } from "@vue-hero-icons/outline" // not supported in v3
const links = [
    {
        'name': 'Sobre',
        'href': '/sobre'
    },
    {
        'name': 'Contacto',
        'href': '/contacto'
    },
]

export default {
    name: "Nav",
    setup(){
        return{
            links
        }
    },
    components:{MenuIcon}
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
</style>
