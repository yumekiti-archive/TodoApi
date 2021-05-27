<template>
    <div>
        <v-app-bar color="blue">

            <v-app-bar-nav-icon @click="drawer = true">
                
            </v-app-bar-nav-icon>

            <v-toolbar-title>Stocklist</v-toolbar-title>

        </v-app-bar>
        

        <v-navigation-drawer
            v-model="drawer"
            fixed
            temporary
        >
            <v-list nav>
                <v-list-item-group>

                    <router-link to="/">
                        <v-list-item>
                            ホーム
                        </v-list-item>
                    </router-link>

                    <router-link to="/login">
                        <v-list-item>
                            ログイン
                        </v-list-item>
                    </router-link>

                    <router-link to="/item">
                        <v-list-item>
                            物一覧
                        </v-list-item>
                    </router-link>

                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
            
    </div>
</template>

<script>
    export default {
        name: 'Header',
        data () {
            return {
                drawer: false,
            }
        },
    }
</script>