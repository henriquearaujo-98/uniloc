<template>
    <!-- Load required Bootstrap and BootstrapVue CSS -->
<!--    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css" />-->
<!--    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />-->

    <Header />

  <router-view/>

    <Footer />
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background: #2c3e50;
  text-align: center;
  color: #2c3e50;
}

</style>
<script>

import Header from "@/components/Header";
import Footer from "@/components/Footer";
export default {
    components: {Footer, Header},
    created() {
        const last_updated = new Date(localStorage.getItem('last_updated'))
        const now = new Date()
        const diffTime = Math.abs(now - last_updated); // milliseconds
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if(diffDays > 1)
            localStorage.clear()
    }
}
</script>
