<template>
    <v-app>
        
        <Header />

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
        async login() {
            let email = this.email;
            let password = this.password;
            let postLogin = async (email, pw)=>{
                await axios.get('api/csrf-cookie');
                await axios.post("/api/login", {
                    email: email,
                    password: pw
                })
            }
            postLogin(email, password).then(response => {
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
