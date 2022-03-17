<template>
    <div class="slider-container">
        <div class="flex">
            <label class="self-start">{{ label }}</label>
        </div>
        <vue-slider @change="onChange" v-model="value" v-bind="{'min' : this.min, 'max' : this.max}"></vue-slider>
    </div>

</template>

<script>
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'

export default {

    name: "SliderFilter",
    components: { VueSlider },
    props: {
      label : String,
      min: Number,
      max: Number,
      store_var_name : String,
    },
    setup(){
        return{
            value: [0, 200]
        }
    },
    created() {
        this.value = [this.min, this.max]
    },
    methods:{
        onChange(){

            const info = {
                'min' : this.value[0],
                'max' : this.value[1],
                'where' : this.store_var_name
            }

            this.$store.dispatch(`search_store/set_slider`, info)
        }
    },
}
</script>

<style scoped>
.slider-container{
    width: 300px;
    padding: 0 15px 0 15px;
}
</style>
