<template>
    <div style="width: 50%" class="mr-10 flex-1 h-max flex pb-6 pr-4 rounded-md">
        <form class="self-start" @submit="onSubmit">
            <TextFilter label="Distritos"
                        tabela="distritos"
                        @done_loading="buffer_toggle"/>


            <TextFilter label="Cidades"
                        tabela="cidades"
                        @done_loading="buffer_toggle"/>
            <TextFilter label="Instituições"
                        tabela="instituicoes"
                        @done_loading="buffer_toggle"/>
            <TextFilter label="Areas"
                        tabela="area_estudo"
                        @done_loading="buffer_toggle"/>
            <TextFilter label="Curso"
                        tabela="cursos"
                        @done_loading="buffer_toggle"/>
            <TextFilter label="Tipo de instituição"
                        tabela="tipos_ensino"
                        @done_loading="buffer_toggle"/>
            <TextFilter label="Provas de ingresso"
                        tabela="exames"
                        @done_loading="buffer_toggle"/>
            <SliderFilter label="Nota Minima"
                          min=95
                          max=200
                          store_var_name="nota_min"
                          class="mt-4"/>
            <SliderFilter label="Rank"
                          min=1
                          max=100
                          optional="true"
                          store_var_name="rank"
                          class="mt-5"/>

            <button type="submit" class="mt-3 inline-block px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Procurar</button>
        </form>
    </div>
</template>

<script>
import TextFilter from "@/components/Filtros/TextFilter/TextFilter.vue";
import SliderFilter from "@/components/Filtros/SliderFilter/SliderFilter.vue";



export default {
    name: "FilterForm",
    components: {TextFilter, SliderFilter},
    setup(){
        let buffNum = 0;
        return{
            buffNum : 0,
        }
    },
    created() {
        this.$store.state['buffer_store'].buffering = true
    },
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
            this.$store.state['buffer_store'].buffering = true
            await this.$store.dispatch(`results_store/get_request`, data)
            this.$store.state['buffer_store'].buffering = false
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
        },
        buffer_toggle(){
            this.buffNum += 1;
            console.log('done' + this.buffNum);
            if(this.buffNum == 7){
                this.$store.state['buffer_store'].buffering = false
            }
        }
    },

}
</script>

<style scoped>
form{
    max-width: 100%;
}

button:hover{
    background-color: #5535ff;
}
</style>
