<template>
    <v-app>
        
        <Header />

        <v-card-title class="mx-auto mt-5">
            <h1 class="display-1">ログインフォーム</h1>
        </v-card-title>

        <v-card width="400px" class="mx-auto mt-5">
            <v-card-text>
                <v-form @submit.prevent="login">
                    <v-text-field
                        prepend-icon="mdi-account-circle"
                        label="メールアドレス"
                        v-model="mailaddress"
                    />
                    <v-text-field
                        v-bind:type="showPassword ? 'text' : 'password'"
                        @click:append="showPassword = !showPassword"
                        prepend-icon="mdi-lock" 
                        v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        label="パスワード"
                        v-model="password"
                    />
                    <v-card-actions>
                        <v-btn class="info" @click="submit">ログイン</v-btn>
                    </v-card-actions>
                </v-form>
            </v-card-text>
        </v-card>
    </v-app>
</template>

<script>
import Header from '@/components/Header.vue'
import axios from 'axios'

export default {
    name: 'Login',
    components: {
        Header
    },
    data(){
        return {
            showPassword : false,
            mailaddress:'',
            password:'',
            errors: {},
        }
    },
    methods:{
        login() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios.post("/api/login", {
                    email: this.email,
                    password: this.password,
                })
                .then(response => {
                    this.$store.dispatch('getUser')
                    this.$router.push({name: 'home'})
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
            })
        },
    }
}
</script>
