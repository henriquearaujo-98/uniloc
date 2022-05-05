<template>
<div class="flex justify-between mr-52 ml-52" style="margin: 5px">
   <FilterForm />
  <Mapa />


</div>
</template>

<script>
import Logo from "@/components/Logo";
import Nav from "@/components/Nav";
import FilterForm from "@/components/FilterForm";
import Mapa from  "@/components/Mapa";


export default {
name: "LandingPage",
components: {FilterForm, Mapa}

}
</script>

<style scoped>

div{
    color: white;
}

</style>
