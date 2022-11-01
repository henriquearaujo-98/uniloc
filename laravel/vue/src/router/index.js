import { createRouter, createWebHashHistory } from 'vue-router'
import LandingPage from "@/views/LandingPage";
import Sobre from "@/views/Sobre";
import Contacto from "@/views/Contacto";
import Informacoes from "@/views/Informacoes";
import Login from "@/views/Login";
import Register from "@/views/Register";
import VerificarEmail from "@/views/VerificarEmail";
import Perfil from "@/views/Perfil";
import NotFound from "@/views/NotFound";
import PassowrdReset from "@/views/PassowrdReset";

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
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/verificar_email',
        name: 'VerificarEmail',
        component: VerificarEmail
    },
    {
        path: '/perfil',
        name: 'Profile',
        component: Perfil
    },
    {
        path: '/404',
        name: '404',
        component: NotFound
    },
    {
        path: '/pw_reset',
        name: 'PasswordReset',
        component: PassowrdReset
    },

]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
