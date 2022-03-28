<template>
    <div style="height: 600px;width: 50%; background: greenyellow;flex: 1" class="ml-10">
        <ol-map :loadTilesWhileAnimating="true" :loadTilesWhileInteracting="true" style="height:100%">

            <ol-view ref="view" :center="center" :rotation="rotation" :zoom="zoom"
                     :projection="projection" />

            <ol-tile-layer>
                <ol-source-osm />
            </ol-tile-layer>

        </ol-map>
        <Marker item=""/>
    </div>
</template>

<script>
import {ref} from 'vue'
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
            rotation
        }
    },
}
</script>

<style scoped>

</style>
