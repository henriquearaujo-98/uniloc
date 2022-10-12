<template>
<div ref="message-container" :class="message === '' ? '' : 'open-message'" :style="'background:'+color">
    <div ref="message-content" :class=" message === '' ? 'content' : 'content fadein'">
        <span   class="message" ref="message-text">{{ message }}</span>
        <span   @click="close" class="close" >{{message === '' ? '' : 'X'}}</span>
    </div>
</div>
</template>

<script>
export default {
    name: "Message",
    setup(){
        return{
            message: '',
            color: '',
            hide: false
        }
    },
    methods:{
        close(){
            this.$store.state['message_store'].message = ''
            this.$store.state['message_store'].color = ''
            this.hide = true
        },
    },
    computed:{
        message(){
            this.color = this.$store.state['message_store'].color
            return this.$store.state['message_store'].message
        }
    },
    watch: {
        message(n, o){
            this.message = n;
            this.hide = false
        }
    }
}
</script>

<style scoped>
div{
    width: 100%;
    margin-bottom: 10px;
    height: 0;
    transition: 0.5s;
    position: absolute;
}

.content{
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    transform: translate(0, 25px);
    opacity: 0;
    transition: 1s;


}

.fadein{
    opacity: 1;
}


span{
    align-self: center;
}

.message{
    color: white;
}

.open-message{
    height: 50px !important;
}

.close{
    color: white;
    cursor: pointer;

}
</style>
