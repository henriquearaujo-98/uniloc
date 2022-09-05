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

            <ol-image-layer :zIndex="1001">
                <ol-source-image-wms url="https://sig.lneg.pt/server/services/CGP1M/MapServer/WMSServer"  :extent="[-13884991, 2870341, -7455066, 6338219]" layers="topp:states" />
            </ol-image-layer>

            <ol-overlay style="position: absolute; z-index: 0; transform: translate(0, -80px);" v-for="item in $store.state['results_store'].results_unique" :position="[item[0].instituicao[0].longitude,item[0].instituicao[0].latitude]">
                <Marker :item='item'
                        :rank="item[0].rank"
                        :inst="item[0].instituicao[0].nome"
                        @onMouse=""/>
            </ol-overlay>
        </ol-map>


    <br>

</template>

<script>
import { ref } from 'vue'
import Marker from "@/components/Marker";

export default {
    name: "Mapa",
    components: {Marker},
    setup() {
        const center = ref([  -7.849468119216156,39.399872])
        const projection = ref('EPSG:4326')
        const zoom = ref(7.6)
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
