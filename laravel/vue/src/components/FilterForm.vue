<template>
    <div style="background: deeppink; width: 50%" class="mr-10 flex-1 h-96 flex">
        <form class="self-start" @submit="onSubmit">
            <TextFilter label="Distritos"
                        tabela="distritos"/>
<!--            <TextFilter label="Cidades"
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
                          store_var_name="rank"/>-->

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
        onSubmit(e){
            e.preventDefault();
            const distritos = this.array_to_string(JSON.parse(JSON.stringify(this.$store.state.search_store['distritos'])));
            const data = {
                'distritos' : distritos
            }
            console.log(distritos)
            //this.$store.dispatch(`results_store/get_request`, this.$store.state.search_store)
        },
        array_to_string(arr){

            if(arr.length == 0)
                return ''

            let txt = String
            for(let i = 0; i < arr.length; i++){
                if(i == 0){
                    txt = arr[i]
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
