<template>
    <div style="background: deeppink; width: 50%" class="mr-10 flex-1 h-96 flex">
        <form class="self-start" @submit="onSubmit">
            <TextFilter label="Distritos"
                        tabela="distritos"/>
            <TextFilter label="Cidades"
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
                        tabela="exames"/>
            <SliderFilter label="Nota Minima"
                          min=95
                          max=200
                          store_var_name="nota_min"/>
            <SliderFilter label="Rank"
                          min=1
                          max=100
                          optional="true"
                          store_var_name="rank"/>

            <button type="submit">Procurar</button>

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
        async onSubmit(e){
            e.preventDefault();
            const distritos = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['distritos'])));
            const cidade = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['cidades'])));
            const insts = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['instituicoes'])));
            const areas = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['area_estudo'])));
            const cursos = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['cursos'])));
            const provas = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['exames'])));
            const tipos_ensino = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['tipos_ensino'])));
            const nota_min_min = this.$store.state.search_store['nota_min_min'];
            const nota_min_max = this.$store.state.search_store['nota_min_max'];
            const rank_min = this.$store.state.search_store['rank_min'];
            const rank_max = this.$store.state.search_store['rank_max'];
            const data = {
                'distritos' : distritos,
                'cidade' : cidade,
                'insts' : insts,
                'areas' : areas,
                'cursos' : cursos,
                'provas' : provas,
                'tipos_inst' : tipos_ensino,
                'nota_min_min' : nota_min_min,
                'nota_min_max' : nota_min_max,
                'rank_min' : rank_min,
                'rank_max' : rank_max
            }

            await this.$store.dispatch(`results_store/get_request`, data)
            await this.$store.dispatch(`results_store/mapAPI`)
        },
        array_to_string(arr){

            if(arr.length == 0)
                return ''

            let txt = String
            for(let i = 0; i < arr.length; i++){
                if(i == 0){
                    txt = arr[i].toString()
                    continue
                }
                txt = txt + ',' + arr[i]
            }

            return txt
        }

    },

}
</script>

<style scoped>
form{
    max-width: 100%;
}
</style>
