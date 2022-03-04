<template>
<div class="flex justify-between mr-52 ml-52" >
   <FilterForm />
    <div style="height: 600px;width: 50%; background: greenyellow;flex: 1" class="ml-10">
        <h1>MAPA</h1>
    </div>
</div>
</template>

<script>
import Logo from "@/components/Logo";
import Nav from "@/components/Nav";
import FilterForm from "@/components/FilterForm";

export default {
name: "LandingPage",
components: {FilterForm}

}
</script>

<style scoped>

div{
    color: white;
}

</style>
