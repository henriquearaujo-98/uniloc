<template>
    <div style="height: 600px;width: 50%; background: greenyellow;flex: 1" class="ml-10">
        <ol-map :loadTilesWhileAnimating="true" :loadTilesWhileInteracting="true" style="height:100%">

            <ol-view ref="view" :center="center" :rotation="rotation" :zoom="zoom"
                     :projection="projection" />

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

    </div>
</template>

<script>
import { ref } from 'vue'
import Marker from "@/components/Marker";

export default {
    name: "Mapa",
    components: {Marker},
    setup() {
        const center = ref([ -8.224454,39.399872])
        const projection = ref('EPSG:4326')
        const zoom = ref(6.5)
        const rotation = ref(0)

        return {
            center,
            projection,
            zoom,
            rotation,

        }
    },

}
</script>

<style scoped>
.overlay-content{
    background: red;
}
</style>
