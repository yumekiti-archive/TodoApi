<template>
    <div>
        <Header />
        <p>test json</p>
        <div v-if="tododata">
            <div>
                <v-card elevation="2" v-for="todo in tododata.data" :key="todo.id" ma="2">
                    <v-card-title>{{ todo.title }}</v-card-title>
                </v-card>
            </div>
            <p>
                ログイン：{{ tododata.statusText }} 
            </p>
        </div>
        <div v-else>
            <v-progress-circular indeterminate />
        </div>
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
            info: null,
            tododata: null
        }
    },
    mounted () {
        axios
        .get('/api/groups/1')
        .then(response => (this.tododata = response));
    }
}
</script>
