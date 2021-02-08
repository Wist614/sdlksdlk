<template>
  <v-container fill-height justify-center>
    <v-card width="500">
      <!-- ------------------------------------ STEP HEADER ----------------------------------- -->
      <v-card-text class="text-center">
        <v-img
          :src="require(`@/assets/${currentStepHeader.picture}.svg`)"
          height="100"
          contain
        ></v-img>
        <div class="text--primary text-h6">{{ currentStepHeader.title }}</div>
        <div>{{ currentStepHeader.subtitle }}</div>
      </v-card-text>

      <!-- ----------------------------------- FORM WINDOWS ----------------------------------- -->
      <v-window
        v-model="step"
        touchless
      >
        <!-- -------------------------------- FIRST WINDOW -------------------------------- -->
        <v-window-item :value="0">
          <v-card-text>
            <v-select
              label="Cours"
              v-model="selLesson"
              :items="lessons"
              item-text="name"
              return-object
              filled
              @change="justifications = []"
            ></v-select>
          </v-card-text>
        </v-window-item>

        <!-- -------------------------------- SECOND WINDOW ------------------------------- -->
        <v-window-item :value="1">
          <v-card-text v-if="selLesson">
            <v-row>
              <template v-for="(capacity, index) in selLesson.capacities">
                <v-col :key="`cap${index}`" cols="12">
                  {{ capacity }}
                </v-col>
                <v-col :key="`justif${index}`" cols="12">
                  <v-textarea
                    hint="Justifiez en quoi vous maitrisez déjà cet acquis d'apprentissage"
                    filled
                    label="Justification"
                    v-model="justifications[index]"
                  ></v-textarea>
                </v-col>
              </template>
            </v-row>
          </v-card-text>
        </v-window-item>

        <!-- -------------------------------- THIRD WINDOW -------------------------------- -->
        <v-window-item :value="2">
          <v-card-text>
            <v-file-input
              label="Annexe(s) au format PDF"
              chips
              show-size
              counter
              filled
              multiple
            >
              <template v-slot:append-outer>
                <v-dialog
                  v-model="showHelpDial"
                  max-width="600"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      v-bind="attrs"
                      v-on="on"
                      icon
                    >
                      <v-icon>mdi-help</v-icon>
                    </v-btn>
                  </template>
                  <v-card>
                    <v-card-title class="white--text info">
                      Aide pour l'ajout de documents probants
                    </v-card-title>
                    <v-virtual-scroll
                      :items="items"
                      :item-height="30"
                      height="300"
                    >
                      <template v-slot:default="{ item }">
                        <v-subheader v-if="item.header">{{ item.header }}</v-subheader>
                        <v-list-item v-else>
                          <v-list-item-content>
                            <v-list-item-title class="text-caption">
                              {{ item.name }}
                            </v-list-item-title>
                          </v-list-item-content>
                        </v-list-item>
                      </template>
                    </v-virtual-scroll>
                    <v-divider></v-divider>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                        @click="showHelpDial = false"
                        text
                        color="primary"
                      >
                        Fermer
                      </v-btn>
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </template>
            </v-file-input>

            <!-- <v-autocomplete
              label="Genre"
              :items="checkboxes"
              item-text="name"
              item-value="id"
              multiple
              small-chips
              filled
            ></v-autocomplete> -->
          </v-card-text>
        </v-window-item>
      </v-window>

      <!-- -------------------------------------- ACTIONS ------------------------------------- -->
      <v-card-actions class="justify-space-between">
        <!-- --------------------------------- PREVIOUS BUTTON -------------------------------- -->
        <v-btn
          text
          @click="step--"
          :disabled="step === 0"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>

        <!-- --------------------------------- STEPS INDICATOR -------------------------------- -->
        <v-item-group
          v-model="step"
          mandatory
        >
          <v-item
            v-for="(key, index) in Object.keys(stepHeaders)"
            :key="`item-step-${index}`"
            v-slot="{ active }"
            disabled
          >
            <v-btn
              x-small
              :input-value="active"
              icon
              :color="index <= step ? 'primary': ''"
            >
              <v-icon>mdi-record</v-icon>
            </v-btn>
          </v-item>
        </v-item-group>

        <!-- ----------------------------------- NEXT BUTTON ---------------------------------- -->
        <v-btn
          text
          @click="step++"
          :disabled="step === Object.keys(stepHeaders).length - 1"
        >
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
export default {
  name: 'Form',

  data: () => ({
    showHelpDial: false,
    selLesson: null,
    justifications: [],
    items: [
      { header: 'Issus de mon parcours dans l\'enseignement' },
      { id: 1, name: 'Originaux de diplôme, certificat, brevet, attestation de réussite, titre, bulletin' },
      { id: 2, name: 'Programme, référentiel, contenu de cours, acquis d\'apprentissage, crédits obtenus, fiche ECTS' },
      { id: 3, name: 'Grille horaire, nombre d\'heures de cours, relevé d\'heures de stage effectuées, rapport...' },
      { id: 4, name: 'Autres' },
      { header: 'Issus de mon parcours dans des organismes de formation ou des centres de validation' },
      { id: 5, name: 'Titres de compétence' },
      { id: 6, name: 'Unités d\'acquis d\'apprentissage' },
      { id: 7, name: 'Attestation' },
      { id: 8, name: 'Autres' },
      { header: 'Issus de mon expérience professionnelle' },
      { id: 9, name: 'Copie de contrat de travail' },
      { id: 10, name: 'Description de fonction, attestation de service, de tâches ou activités réalisées' },
      { id: 11, name: 'Projet, portfolio, cahier individuel de compétences' },
      { id: 12, name: 'Autres: à compléter' },
      { header: 'Issus de mon expérience personnelle' },
      { id: 13, name: 'Descriptif des activités liées aux loisirs, à la famille, au bénévolat...' },
      { id: 14, name: 'Compétences linguistiques' },
      { id: 15, name: 'Auto-formation ou autres' },
    ],
    lessons: [
      {
        id: 1,
        name: 'Analyse et conception',
        capacities: [
          'Fusce at eros in turpis maximus porta eu ac elit. Cras non nisl vitae risus consequat vehicula eu sed orci. Nam mollis arcu vitae accumsan tempus. Duis eget dui a mauris bibendum venenatis. Pellentesque nibh metus, varius sit amet pretium quis, imperdiet sit amet dolor. Ut malesuada non urna volutpat interdum. Nam posuere est vel ultrices pharetra. Morbi ac arcu id urna faucibus ultricies.',
          'Sed elementum ac augue id lacinia. Donec tristique diam maximus maximus lacinia. Morbi commodo erat vel tortor facilisis, sit amet imperdiet nulla commodo. Morbi sollicitudin pulvinar ante. Phasellus eget ligula ac mi dignissim posuere. Nunc fermentum arcu ipsum, eget rhoncus turpis posuere tempus. Suspendisse egestas iaculis arcu, sed tempus libero iaculis et.',
          'Vestibulum sodales pretium varius. Etiam ut convallis arcu, eu dapibus ligula. In consectetur diam id urna vestibulum, nec ullamcorper velit scelerisque. Vestibulum metus orci, convallis a lectus in, cursus ornare orci. Donec magna mauris, scelerisque a eleifend vitae, dictum et augue. Aenean nec tristique eros. Quisque eget felis ut metus efficitur vestibulum. ',
        ],
      },
      {
        id: 2,
        name: 'Veille technologique',
        capacities: [
          'Sed elementum ac augue id lacinia. Donec tristique diam maximus maximus lacinia. Morbi commodo erat vel tortor facilisis, sit amet imperdiet nulla commodo. Morbi sollicitudin pulvinar ante. Phasellus eget ligula ac mi dignissim posuere. Nunc fermentum arcu ipsum, eget rhoncus turpis posuere tempus. Suspendisse egestas iaculis arcu, sed tempus libero iaculis et.',
          'Fusce at eros in turpis maximus porta eu ac elit. Cras non nisl vitae risus consequat vehicula eu sed orci. Nam mollis arcu vitae accumsan tempus. Duis eget dui a mauris bibendum venenatis. Pellentesque nibh metus, varius sit amet pretium quis, imperdiet sit amet dolor. Ut malesuada non urna volutpat interdum. Nam posuere est vel ultrices pharetra. Morbi ac arcu id urna faucibus ultricies.',
        ],
      },
      {
        id: 3,
        name: 'Projet WEB',
        capacities: [
          'Fusce at eros in turpis maximus porta eu ac elit. Cras non nisl vitae risus consequat vehicula eu sed orci. Nam mollis arcu vitae accumsan tempus. Duis eget dui a mauris bibendum venenatis. Pellentesque nibh metus, varius sit amet pretium quis, imperdiet sit amet dolor. Ut malesuada non urna volutpat interdum. Nam posuere est vel ultrices pharetra. Morbi ac arcu id urna faucibus ultricies.',
        ],
      },
    ],
    step: 0,
    stepHeaders: {
      credentials: {
        picture: 'undraw_authentication_fsn5',
        title: 'Choix du cours',
        subtitle: 'Sélectionnez le cours pour lequel vous souhaitez demander une dispense',
      },
      degree: {
        picture: 'undraw_certification_aif8',
        title: 'Acquis d\'apprentissage',
        subtitle: 'Justifiez votre maitrise des acquis d\'apprentissage',
      },
      address: {
        picture: 'undraw_delivery_address_03n0',
        title: 'Annexe(s)',
        subtitle: 'Ajoutez vos documents probants',
      },
    },
  }),

  computed: {
    currentStepHeader() {
      switch (this.step) {
        case 0: return this.stepHeaders.credentials;
        case 1: return this.stepHeaders.degree;
        default: return this.stepHeaders.address;
      }
    },
  },
};
</script>
