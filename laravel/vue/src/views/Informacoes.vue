<template>
    <div v-if="this.state.isFetching == false" style="margin: 0 60px">
        <h1>{{item[0].curso[0].nome}}</h1>
        <h2 class="inst">{{item[0].instituicao[0].nome}}</h2>
        <hr>
        <br><br>
        <div class="flex space-x-8" style="justify-content: space-between">
            <div class="card">
                <h4 style="color: black">
                    Exames de ingresso
                </h4>
                <div v-for="(exame, index) in item[1]">
                    {{exame}}
                    <div v-if="item[1][index+1]">ou</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Nota Minima
                </h4>
                <div>
                    <div>1º Fase: {{item[0].nota_ult_1fase}}</div>
                    <div>2º Fase: {{item[0].nota_ult_2fase}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Tipo de Ensino
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].tipo_ensino.nome}}</div>
                </div>
            </div>
            <a class="card" style="color: black; text-decoration: none" :href=item[0].plano_curso>
                <h4 style="color: black">
                    Plano de estudos
                </h4>
            </a>
            <a class="card" style="color: black; text-decoration: none" :href=this.dges>
                <h4 style="color: black">
                    DGES
                </h4>
            </a>
        </div>
        <h4>Dados geográficos</h4>
        <div class="flex space-x-4" style="justify-content: space-between">
            <div class="card">
                <h4 style="color: black">
                    Cidade
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.nome}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Cidade
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.nome}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Cidade
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.distrito.nome}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    População residente
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['População residente']}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Renda mensal: 100€ - 199,99€ (%)
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 100€ - 199,99€']}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Renda mensal: 200€ - 399,99€ (%)
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 200€ - 399,99€']}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Renda mensal: 400€ - 649,99€ (%)
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 400€ - 649,99€']}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Renda mensal: 650 - 999,99€ (%)
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: 650€ - 999,99€']}}</div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: black">
                    Renda mensal: >= 1000€ (%)
                </h4>
                <div>
                    <div>{{item[0].instituicao[0].codigo_postal.cidade.municipio.informacoes['Renda mensal: >=1000€']}}</div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <h1 style="background: white; color: black; width: 300px; height: 300px">Fetching...</h1>
    </div>
</template>

<script>
import axios from "axios";
import {reactive} from "vue";

export default {
    name: "Informacoes",
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
        console.log(this.instID)
        console.log(this.cursoID)
        console.log(this.state.isFetching)
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
        this.state.isFetching = false;
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
