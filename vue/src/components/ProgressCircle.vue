<template>
    <div>
        <v-progress-circular v-bind:class="{ horizontal: isActive }" style="width: 200px; height: 200px;" indeterminate />
    </div>
</template>

<script>
    export default {
        name: 'Header',
        data () {
            return {
                isActive: false,
            }
        },
        mounted () {
            setInterval(this.setload,3000);
        },
        methods: {
            setload(){
                if(!this.isActive){
                    this.isActive = true
                }else{
                    this.isActive = false
                }
            }
        }
    }
</script>
<style>
.horizontal {
    transform: scale(-1, 1);
    animation-duration:1s;
}
</style>