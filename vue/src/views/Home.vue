<template>
    <div>
        <Header />
        <p>test json</p>
        {{ info }}
    </div>
</template>

<script>
import Header from '@/components/Header.vue'
import axios from 'axios'

export default {
    name: 'Home',
    components: {
        Header
    },
    data () {
        return {
            info: null
        }
    },
    mounted () {
        axios
        .get('/api/groups/1')
        .then(response => (this.info = response))
    }
}
</script>
