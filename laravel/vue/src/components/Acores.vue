<template>

    <ol-map :loadTilesWhileAnimating="true" :loadTilesWhileInteracting="true" style="height:100%">

        <ol-view ref="view"
                 :center="center"
                 :rotation="rotation"
                 :zoom="zoom"
                 :projection="projection"
                 @zoomChanged="zoomChanged"
                 @centerChanged="centerChanged"
                 @resolutionChanged="resolutionChanged"
                 @rotationChanged="rotationChanged"/>

        <ol-tile-layer>
            <ol-source-xyz url="https://tile.thunderforest.com/atlas/{z}/{x}/{y}.png?apikey=737fcf9a3edb415e9309ff5888c9ecdc" />
        </ol-tile-layer>

        <ol-animated-clusterlayer :animationDuration="500" :distance="40">
            <ol-source-vector ref="vectorsource">
                <ol-feature v-for="item in $store.state['results_store'].results_unique">
                    <ol-geom-point
                        :coordinates="[parseFloat(item[0].instituicao[0].longitude), parseFloat(item[0].instituicao[0].latitude)]"
                    ></ol-geom-point>
                    <ol-overlay style="position: absolute; z-index: 0; transform: translate(0, -80px);" v-for="item in $store.state['results_store'].results_unique" :position="[item[0].instituicao[0].longitude,item[0].instituicao[0].latitude]">
                        <Marker :item='item'
                                :rank="item[0].rank"
                                :inst="item[0].instituicao[0].nome"
                                @onMouse=""/>
                    </ol-overlay>
                </ol-feature>
            </ol-source-vector>

            <ol-style :overrideStyleFunction="overrideStyleFunction">
                <ol-style-stroke color="red" :width="2"></ol-style-stroke>
                <ol-style-fill color="rgba(255,255,255,0.1)"></ol-style-fill>

                <ol-style-circle :radius="20">
                    <ol-style-stroke color="black" :width="15" :lineDash="[]" lineCap="butt"></ol-style-stroke>
                    <ol-style-fill color="black"></ol-style-fill>
                </ol-style-circle>

                <ol-style-text>
                    <ol-style-fill color="white"></ol-style-fill>
                </ol-style-text>
            </ol-style>
        </ol-animated-clusterlayer>

    </ol-map>


    <br>

</template>

<script>
import { ref } from 'vue'
import Marker from "@/components/Marker";

export default {
    name: "Acores",
    components: {Marker},
    setup() {
        const center = ref([  -28.153342689382498,38.50143457450581])
        const projection = ref('EPSG:4326')
        const zoom = ref(6)
        const rotation = ref(0)

        const overrideStyleFunction = (feature, style) => {

            let clusteredFeatures = feature.get('features');
            let size = clusteredFeatures.length;

            let color = size > 20 ? "192,0,0" : size > 8 ? "255,128,0" : "0,128,0";
            var radius = Math.max(8, Math.min(size, 20));
            let dash = 2 * Math.PI * radius / 6;
            let calculatedDash = [0, dash, dash, dash, dash, dash, dash];

            style.getImage().getStroke().setLineDash(dash);
            style.getImage().getStroke().setColor("rgba(" + color + ",0.5)");
            style.getImage().getStroke().setLineDash(calculatedDash);
            style.getImage().getFill().setColor("rgba(" + color + ",1)");

            style.getImage().setRadius(radius)

            style.getText().setText(size.toString());

        }

        const getRandomInRange = (from, to, fixed) => {
            return (Math.random() * (to - from) + from).toFixed(fixed) * 1;

        }

        const featureSelected = (event) => {
            console.log(event)

        }

        return {
            center,
            projection,
            zoom,
            rotation,
            getRandomInRange,
            overrideStyleFunction,
            featureSelected
        }
    },
    data() {
        return {
            currentCenter: this.center,
            currentZoom: this.zoom,
            currentResolution: this.resolution,
            currentRotation: this.rotation,
        };
    },


}
</script>

<style scoped>
.overlay-content{
    background: red;
}
</style>

