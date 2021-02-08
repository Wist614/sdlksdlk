<template>
  <v-container>
    <v-card>
      <v-card-title>
        Demandes
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Rechercher"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="requests"
        :search="search"
        @click:row="manageReq"
      ></v-data-table>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    search: '',
    headers: [
      { text: 'Prénom', value: 'firstName' },
      { text: 'Nom', value: 'lastName' },
      { text: 'Cours', value: 'lesson' },
      { text: 'Date demande', value: 'dateReq' },
      { text: 'Statut', value: 'status' },
      { text: 'Date décision', value: 'dateRes' },
    ],
    requests: [
      {
        lastName: 'Hunin',
        firstName: 'Nicolas',
        lesson: 'Veille technologique',
        dateReq: '12/11/2020',
        status: 'Accepté',
        dateRes: '02/12/2020',
      },
      {
        lastName: 'Vermoesen',
        firstName: 'Stephan',
        lesson: 'Veille technologique',
        dateReq: '17/11/2020',
        status: 'En attente',
        dateRes: '',
      },
      {
        lastName: 'Conreur',
        firstName: 'Sébastien',
        lesson: 'Projet SGBD',
        dateReq: '20/11/2020',
        status: 'Refusé',
        dateRes: '02/12/2020',
      },
    ],
  }),

  methods: {
    manageReq(request) {
      console.log(request);
    },
  },
};
</script>
