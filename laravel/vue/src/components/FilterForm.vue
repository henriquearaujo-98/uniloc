<template>
    <div style="background: deeppink; width: 50%" class="mr-10 flex-1 h-96 flex">
        <form class="self-start" @submit="onSubmit">
            <TextFilter label="Distritos"
                        tabela="distritos"
                        @selected-filter-option="select_distritos"/>
        </form>
    </div>
</template>

<script>
import TextFilter from "@/components/Filtros/TextFilter";
export default {
    name: "FilterForm",
    components: {TextFilter},
    data(){
        return {
            distritos: [],
            cidades: [],
            insts: [],
            areas: [],
            cursos: [],
            tipos_inst: [],
            provas: [],
            nota_min_min: [],
            nota_min_max: [],
            rank_min: [],
            rank_max: []
        }
    },
    methods: {
        onSubmit(e){
            e.preventDefault();
        },

        select_distritos(distrito){
            this.distritos=distrito;
            console.log(this.distritos)
        }
    },

}
</script>

<style scoped>
form{
    max-width: 100%;
}
</style>
