<!-- TextFilter component -->
<template>
    <div style="width: 100%; max-height: 15px" class="p-5;">
        <div class="flex">
            <label class="self-start">{{ label }}</label>
        </div>
        <!-- TextInput Component -->
        <div class="flex" style="position: relative; max-width: 100%">
            <div>
                <input type="text" name="text" v-model="text" style="color: black" class="mr-5">
                <!-- Auto complete component-->
                <div style="background: lightslategrey">
                    <ul>
                        <li v-for="item in options" :key="item.id" @click="select_item(item)">{{ item.nome }}</li>
                    </ul>
                </div>
                <!-- Auto complete component-->
            </div>
        <!-- TextInput Component -->
            <!-- ResultsArea Component -->
            <div class="inline overflow-x-scroll flex-1" style="position: relative; height: 50px">
                <span v-for="item in selected" :key="item.id"  class="mr-3">
                    {{item.nome}}
                </span>
            </div>
            <!-- ResultsArea Component -->
        </div>

    </div>
</template>
<!-- Filter component -->

<script>


export default {
    name: "TextFilter",
    props:{
        label: String,
        tabela: String
    },
    data(){
        return {
            options : [],   // opções cujo texto selecionado corresponde á pool de informação
            selected: [],   // items selecionados do dropdown para fazer request á api
            pool: [],  // pool de informação
            text: ''
        }
    },
    created() {
        this.pool = [
            {
                id: 0,
                nome: 'Açores'
            },
            {
                id: 1,
                nome: 'Bragança'
            },
            {
                id: 2,
                nome: 'Braga'
            },
            {
                id: 3,
                nome: 'Porto'
            },
            {
                id: 4,
                nome: 'Viana do Castelo'
            },
            {
                id: 5,
                nome: 'Vila Real'
            },
            {
                id: 6,
                nome: 'Santarem'
            },
            {
                id: 7,
                nome: 'Lisboa'
            },
            {
                id: 8,
                nome: 'Aveiro'
            },
            {
                id: 9,
                nome: 'Algarve'
            }
        ];
    },
    methods:{
        get_like(text){

            if(text === ''){
                this.options = [];
                return;
            }

            this.options = this.pool.filter(element => {
                if (element.nome.indexOf(text) !== -1) {
                    return true;
                }
            })
        },

        select_item(item){
            this.selected.push(item)
            this.$emit('selected-filter-option', this.selected);
        }
    },
    watch: {
        text(val) { // nome do v-model
            this.get_like(val);
        }
    }
}
</script>

<style scoped>
span{
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}

li:hover{
    cursor: pointer;
    background: dimgrey;
}

</style>
