<template>
    <div style="height: 600px;width: 50%; background: greenyellow;flex: 1" class="ml-10">
        <ol-map :loadTilesWhileAnimating="true" :loadTilesWhileInteracting="true" style="height:100%">

            <ol-view ref="view" :center="center" :rotation="rotation" :zoom="zoom"
                     :projection="projection" />

            <ol-tile-layer>
                <ol-source-osm />
            </ol-tile-layer>
            <ol-overlay v-for="item in $store.state['results_store'].results" :position="[item.instituicao[0].longitude,item.instituicao[0].latitude]">
                <Marker :item='item'
                        :rank="item.rank"
                        :inst="item.instituicao[0].nome"/>
            </ol-overlay>


            <ol-interaction-clusterselect @select="featureSelected" :pointRadius="20">
                <ol-style>
                    <ol-style-stroke color="green" :width="5"></ol-style-stroke>
                    <ol-style-fill color="rgba(255,255,255,0.5)"></ol-style-fill>
                    <ol-style-icon :src="markerIcon" :scale="0.05"></ol-style-icon>
                </ol-style>
            </ol-interaction-clusterselect>

            <ol-animated-clusterlayer :animationDuration="500" :distance="40">
                <ol-source-vector ref="vectorsource">
                    <ol-feature v-for="item in $store.state['results_store'].results">
                        <ol-geom-point
                            :coordinates="[getRandomInRange(item.instituicao[0].longitude, 3), getRandomInRange(item.instituicao[0].latitude, 3)]"
                        ></ol-geom-point>
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
        <div style="background: black;" v-for="item in $store.state['results_store'].results">
            <Marker :item='item'
                    :rank="item.rank"
                    :inst="item.instituicao[0].nome"/>

        </div>
    </div>
</template>

<script>
import { ref, inject } from 'vue'
import Marker from "@/components/Marker";
import markerIcon from '@/assets/markerIcon.png';

export default {
    name: "Mapa",
    components: {Marker},
    setup() {
        const center = ref([ -8.224454,39.399872])
        const projection = ref('EPSG:4326')
        const zoom = ref(6.5)
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

            console.log(style)

        }

        const getRandomInRange = (value, fixed) => {
             value = parseFloat(value);
             console.log(value);
             return value;

        }

        const featureSelected = (event) => {
            console.log(event)

        }


        return {
            center,
            projection,
            zoom,
            rotation,
            markerIcon,
            overrideStyleFunction,
            getRandomInRange
        }
    },

}
</script>

<style scoped>
.overlay-content{
    background: red;
}
</style>
