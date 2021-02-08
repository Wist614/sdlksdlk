<template>
  <v-app>
    <v-app-bar
      dark
      app
      color="transparent"
      class="d-flex justify-center elevation-0"
    >
      <v-toolbar-title>IETCPS : demande de dispense</v-toolbar-title>
    </v-app-bar>

    <v-main class="my-background">
      <router-view></router-view>
    </v-main>

  </v-app>
</template>

<script>
export default {
  name: 'App',

  data: () => ({
    //
  }),
};
</script>

<style>

.my-background {
  background-image: url('./assets/login-background.jpg');
  background-size: cover;
}

</style>
