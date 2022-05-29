<template>

    <div v-if="this.$store.state['buffer_store'].buffering == false" style="margin: 0 60px">
        <h1>{{item[0].curso[0].nome}}</h1>
        <h2 class="inst">{{item[0].instituicao[0].nome}}</h2>
        <hr>
        <br><br>
        <div class="flex space-x-8" style="justify-content: space-between">
            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Provas de ingresso</h5>
                        <div v-for="(exame, index) in item[1]">
                            {{exame}}
                            <div v-if="item[1][index+1]">ou</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Nota Minima</h5>
                        <div>1º Fase: {{item[0].nota_ult_1fase}}</div>
                        <div>2º Fase: {{item[0].nota_ult_2fase}}</div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Tipo de Ensino</h5>
                        <div>
                            <div>{{item[0].instituicao[0].tipo_ensino.nome}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <a :href=item[0].plano_curso>
                <div class="flex justify-center">
                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                        <div class="p-6">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">Plano de estudos</h5>
                        </div>
                    </div>
                </div>
            </a>

            <a :href=this.dges>
                <div class="flex justify-center">
                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                        <div class="p-6">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">DGES</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <br>
        <h4>Dados geográficos</h4>

        <div class="flex space-x-4" style="justify-content: space-between">
            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Cidade</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.nome}}</div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.nome}}</div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.distrito.nome}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">População residente</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['População residente']}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Renda mensal: 100€ - 199,99€ (%)</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 100€ - 199,99€']}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Renda mensal: 200€ - 399,99€ (%)</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 200€ - 399,99€']}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Renda mensal: 400€ - 649,99€ (%)</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 400€ - 649,99€']}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Renda mensal: 650 - 999,99€ (%)</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 650€ - 999,99€']}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <div class="p-6">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Renda mensal: >= 1000€ (%)</h5>
                        <div>
                            <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: >=1000€']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <Buffer />
    </div>
</template>

<script>
import axios from "axios";
import {reactive} from "vue";
import Buffer from "@/components/Buffer";

export default {
    name: "Informacoes",
    components: {Buffer},
    setup(){
        let item;
        let dges;
        const state = reactive({isFetching: true})
        return{
            item,
            state,
            dges
        }
    },
    async mounted() {
        this.instID = this.$route.query.instID;
        this.cursoID = this.$route.query.cursoID
        this.$store.state['buffer_store'].buffering = true

        await axios.get(`http://localhost:3500/api/instituicoes_has_curso?cursoID=${this.cursoID}&instID=${this.instID}`,
            {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                },

            }).then(res => this.item = res.data);
        console.log(this.item)

        await axios.get(`http://localhost:3500/api/exames_nome?cursoID=${this.cursoID}&instID=${this.instID}`,
            {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                },

            }).then(res => this.item.push(res.data));

        this.item[1].forEach((x, index) => {
            if(x.includes(','))
                this.item[1][index] = this.item[1][index].replace(',', ' e ')
        })

        console.log(this.item)
        this.dges = "https://www.dges.gov.pt/guias/detcursopi.asp?codc="+this.item[0].cursos_ID+"&code="+this.item[0].instituicoes_ID
        this.$store.state['buffer_store'].buffering = false
    },
}
</script>

<style scoped>
h1{
    color: white;
    font-size: 48px;
    text-align: left;
}
h2{
    color: white;
    font-size: 28px;
    text-align: left;
}
h4{
    color: white;
    font-size: 20px;
}
.inst{
    font-size: 24px;
    font-style: italic;
    color: darkorange;
}
.card{
    background: lightgrey;
    padding: 15px;
}
</style>
