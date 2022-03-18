<template>
    <div class="slider-container">
        <div class="flex">
            <input v-if="optional" v-model="state.checked"  @change="onCheckboxChange" type="checkbox">
            <label class="self-start">{{ label }}</label>
        </div>


        <vue-slider @change="onChange"
                    :disabled=!state.checked
                    v-model="value"
                    v-bind="{'min' : this.min, 'max' : this.max}">

        </vue-slider>

    </div>

</template>

<script>
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'
import {reactive} from "vue";

export default {

    name: "SliderFilter",
    components: { VueSlider },
    props: {
      label : String,
      min: Number,
      max: Number,
      store_var_name : String,
      optional : Boolean
    },
    setup(){
        const state = reactive({ checked: true })
        return{
            value: [0, 200],
            state,
        }
    },
    created() {
        this.value = [this.min, this.max]
    },
    methods:{
        log(text){
          console.log(text)
        },
        onChange(){

            const info = {
                'min' : this.value[0],
                'max' : this.value[1],
                'where' : this.store_var_name
            }

            this.$store.dispatch(`search_store/set_slider`, info)
        },
        onCheckboxChange(){
            if(this.state.checked == false)
            this.$store.dispatch(`search_store/unset_slider`, this.store_var_name)
        }
    },
}
</script>

<style scoped>
.slider-container{
    width: 500px;
    padding: 0 15px 0 15px;
}
input{
    display: inline-block;
    margin-right: 5px;
}
</style>
