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
            <ol-source-osm />
        </ol-tile-layer>

        <ol-overlay style="position: absolute; z-index: 0; transform: translate(0, -80px);" v-for="item in $store.state['results_store'].results_unique" :position="[item.instituicao[0].longitude,item.instituicao[0].latitude]">
            <Marker :item='item'
                    :rank="item.rank"
                    :inst="item.instituicao[0].nome"
                    @onMouse=""/>
        </ol-overlay>
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

        return {
            center,
            projection,
            zoom,
            rotation,

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

