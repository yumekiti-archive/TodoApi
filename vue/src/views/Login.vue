<template>
    <v-app>
        
        <Header />

        <v-card-title class="mx-auto mt-5">
            <h1 class="display-1">ログインフォーム</h1>
        </v-card-title>

        <v-card width="400px" class="mx-auto mt-5">
            <v-card-text>
                <v-form>
                    <v-text-field
                        prepend-icon="mdi-account-circle"
                        label="メールアドレス"
                        v-model="email"
                    />
                    <span v-if="errors.email">
                        {{ errors.email[0] }}
                    </span>
                    <v-text-field
                        v-bind:type="showPassword ? 'text' : 'password'"
                        @click:append="showPassword = !showPassword"
                        prepend-icon="mdi-lock" 
                        v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        label="パスワード"
                        v-model="password"
                    />
                    <span v-if="errors.password">
                        {{ errors.password[0] }}
                    </span>
                    <v-card-actions>
                        <v-btn class="info" @click="login">ログイン</v-btn>
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
            email:'',
            password:'',
            errors: []
        }
    },
    methods:{
        login() {
            axios
            .post("/api/login", {
                email: this.email,
                password: this.password
            })
            .then(response => {
                console.log(response);
                localStorage.setItem("auth", "ture");
                this.$router.push("/");
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>
