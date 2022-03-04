<template>
    <div style="background: deeppink; width: 50%" class="mr-10 flex-1 h-96 flex">
        <form class="self-start" @submit="onSubmit">
            <TextInput label="Distritos"
                       tabela="distritos"/>
        </form>
    </div>
</template>

<script>
import TextInput from "@/components/Inputs/TextInput";
export default {
    name: "FilterForm",
    components: {TextInput},
    methods: {
        onSubmit(e){
            e.preventDefault();
        }
    },

}
</script>

<style scoped>
form{
    max-width: 100%;
}
</style>
