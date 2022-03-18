<template>
    <div style="background: deeppink; width: 50%" class="mr-10 flex-1 h-96 flex">
        <form class="self-start" @submit="onSubmit">
            <TextFilter label="Distritos"
                        tabela="distritos"/>
            <!--<TextFilter label="Cidades"
                        tabela="cidades"/>
            <TextFilter label="Instituições"
                        tabela="instituicoes"/>
            <TextFilter label="Areas"
                        tabela="area_estudo"/>
            <TextFilter label="Curso"
                        tabela="cursos"/>
            <TextFilter label="Tipo de instituição"
                        tabela="tipos_ensino"/>
            <TextFilter label="Provas de ingresso"
                        tabela="exames"/>-->
            <SliderFilter label="Nota Minima"
                          min=95
                          max=200
                          store_var_name="nota_min"/>
            <SliderFilter label="Rank"
                          min=1
                          max=100
                          optional="true"
                          store_var_name="rank"/>

        </form>
    </div>

</template>

<script>
import TextFilter from "@/components/Filtros/TextFilter/TextFilter.vue";
import SliderFilter from "@/components/Filtros/SliderFilter/SliderFilter.vue";



export default {
    name: "FilterForm",
    components: {TextFilter, SliderFilter},
    methods: {
        onSubmit(e){
            e.preventDefault();
        },

    },

}
</script>

<style scoped>
form{
    max-width: 100%;
}
</style>
