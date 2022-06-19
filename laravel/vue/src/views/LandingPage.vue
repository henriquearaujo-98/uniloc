<template>
<Buffer v-if="this.$store.state['buffer_store'].buffering == true"/>
<div class="flex justify-between mr-52 ml-52" style="margin: 5px ;max-height: 90vh" >
   <FilterForm />

    <div style="max-height: 45vh;max-width: 35vw; background: greenyellow;flex: 1; flex-direction: column" class="ml-10">
        <Acores :centerY="39.399872"
              :centerX="-7.849468119216156"/>
        <Madeira :centerY="39.399872"
              :centerX="-7.849468119216156"/>
    </div>

    <div style="height: 90vh;max-width: 35vw;flex: 1" class="ml-3">
        <Mapa :centerY="39.399872"
                :centerX="-7.849468119216156"/>
    </div>


</div>
</template>

<script>
import Logo from "@/components/Logo";
import Nav from "@/components/Nav";
import FilterForm from "@/components/FilterForm";
import Mapa from  "@/components/Mapa";
import Acores from "@/components/Acores";
import Madeira from "@/components/Madeira";
import Buffer from "@/components/Buffer";

export default {
name: "LandingPage",
components: {Madeira, Acores, FilterForm, Mapa, Buffer}

}
</script>

<style scoped>

div{
    color: white;
}

</style>

