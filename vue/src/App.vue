<template>
    <v-app>
        <head>
            <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        </head>
        <v-main>
            <router-view/>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name: 'App',
    };
</script>
