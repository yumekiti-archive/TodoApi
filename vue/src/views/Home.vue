<template>
    <div>

        <Header />

        <v-card-title class="mt-5">
            <h1 class="mx-auto">Home</h1>
        </v-card-title>

        <div v-if="tododata">
            <div>
                <v-card elevation="2" v-for="todo in tododata.data" :key="todo.id" ma="2">
                    <v-card-title>{{ todo.title }}</v-card-title>
                </v-card>
            </div>
            <p>
                <br>
                ログイン：{{ tododata.statusText }} 
            </p>
        </div>
        
        <div v-else class="d-flex justify-center pa-2 mt-10">
            <ProgressCircle />
        </div>
        <!-- <p> {{ tododata }} </p> -->
    </div>
</template>

<script>
import Header from '@/components/Header.vue'
import ProgressCircle from '@/components/ProgressCircle.vue'
import axios from 'axios'

export default {
    name: 'Home',
    components: {
        Header,
        ProgressCircle
    },
    data () {
        return {
            tododata: null,
        }
    },
    mounted () {
        axios
        .get('/api/groups/1')
        .then(response => (this.tododata = response));
    },
}
</script>