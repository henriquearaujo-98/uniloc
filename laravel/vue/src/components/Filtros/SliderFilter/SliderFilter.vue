<template>
    <div class="slider-container">
        <div class="flex">
            <input v-if="optional" v-model="checked"  @change="onCheckboxChange" type="checkbox">
            <label class="self-start">{{ label }}</label>
        </div>


        <vue-slider @change="onChange"
                    :disabled=false
                    v-model="value"
                    v-bind="{'min' : this.min, 'max' : this.max}">

        </vue-slider>



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
      optional : Boolean
    },
    setup(){
        return{
            value: [0, 200],
            checked : true,
            show : true,
        }
    },
    created() {
        this.value = [this.min, this.max]
        this.show = !this.optional
    },
    methods:{
        onChange(){

            const info = {
                'min' : this.value[0],
                'max' : this.value[1],
                'where' : this.store_var_name
            }

            this.$store.dispatch(`search_store/set_slider`, info)
        },
        onCheckboxChange(){
            this.checked = !this.checked;
            if(this.checked == true){
                console.log('null rank')
            }
            console.log(this.checked)
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
