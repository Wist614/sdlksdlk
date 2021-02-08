<template>
  <v-container fill-height>
      <v-card class="mx-auto" width="400">
        <v-card-title class="justify-center">Connexion</v-card-title>
        <v-card-text>
          <v-form ref="form">
            <v-text-field
              label="Email"
              v-model="email"
              suffix="@hainaut-promsoc.be"
              outlined
              :rules="rules.email"
            ></v-text-field>
            <v-text-field
              label="Mot de passe"
              v-model="password"
              :append-icon="passIsVisible ? 'mdi-eye-off' : 'mdi-eye'"
              :type="passIsVisible ? 'text' : 'password'"
              @click:append="passIsVisible = !passIsVisible"
              :rules="rules.password"
              outlined
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions class="d-flex flex-column">
          <v-btn
            color="primary"
            dark
            block
            @click="login"
          >
            Se connecter
          </v-btn>

          <a
            class="mt-2"
            target="_blank"
            href="https://ecampus.hainaut-promsoc.be/mot-de-passe-perdu.html"
          >
            Mot de passe oublié ?
          </a>
        </v-card-actions>
      </v-card>
  </v-container>
</template>

<script>
const axios = require('axios').default;

export default {
  name: 'Login',

  data: () => ({
    passIsVisible: false,
    email: '',
    password: '',
    rules: {
      email: [
        (v) => !!v || 'Ce champs est obligatoire',
        (v) => /^[.a-z]+$/.test(v) || 'Le champs ne peut comporter que des minuscules et un point',
      ],
      password: [
        (v) => !!v || 'Ce champs est obligatoire',
      ],
    },
  }),

  methods: {
    async login() {
      if (!this.$refs.form.validate()) return;

      const data = new FormData();
      data.append('email', this.email);
      data.append('password', this.password);

      const response = await axios.post('', data);
      console.log(response.data);
      if (response.data.status === 'ok') this.$router.push('/form');
    },
  },
};
</script>
