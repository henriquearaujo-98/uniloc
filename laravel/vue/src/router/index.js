import { createRouter, createWebHashHistory } from 'vue-router'
import LandingPage from "@/views/LandingPage";
import Sobre from "@/views/Sobre";
import Contacto from "@/views/Contacto";
import Informacoes from "@/views/Informacoes";

const routes = [
    {
    path: '/',
    name: 'home',
    component: LandingPage
    },
    {
        path: '/sobre',
        name: 'sobre',
        component: Sobre
    },
    {
        path: '/contacto',
        name: 'contacto',
        component: Contacto
    },
    {
        path: '/instituicao',
        name: 'instituicao',
        component: Informacoes
    },

]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
