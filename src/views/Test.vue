<template>
  <v-container fill-height justify-center>
    <v-card width="500">
      <v-card-title>Test backend-fronted</v-card-title>
      <v-card-text>
        <v-text-field
          label="ID"
          v-model="id"
          outlined
        ></v-text-field>

        <v-text-field
          label="Nom"
          v-model="name"
          outlined
        ></v-text-field>
      </v-card-text>
      <v-card-actions class="justify-space-between">
        <v-btn
          color="primary"
          @click="getName"
        >
          Get Name
        </v-btn>

        <v-btn
          color="secondary"
          @click="postName"
        >
          Post Name
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
const axios = require('axios').default;

export default {
  name: 'Test',

  data: () => ({
    name: '',
    id: '',
  }),

  methods: {
    getName() {
      axios.get(`http://localhost:8000/backend/getName.php?id=${this.id}`)
        .then((response) => {
          console.log(response);
          if (response.data.status === 'success') {
            console.log(`Le nom correspondant à l'id ${this.id} est ${response.data.message}`);
          } else {
            console.log(response.data.message);
          }
        })
        .catch((error) => console.log(error));
    },
    postName() {
      const data = new FormData();
      data.append('name', this.name);
      axios.post('http://localhost:8000/backend/saveName.php', data)
        .then((response) => {
          if (response.data.status === 'success') {
            console.log('Le post a été exécuté avec succès');
          } else {
            console.log(response.data.message);
          }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
