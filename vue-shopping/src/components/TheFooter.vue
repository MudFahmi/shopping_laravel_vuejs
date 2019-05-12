<template>
  <v-footer
    dark
    height="auto"
  >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class="white">

       <v-btn
        v-for="link in links"
        :key="link"
        color="black"
        flat
        round
      >
        {{ link }}
      </v-btn>
      
          <div class="justify-center black--text"> &copy;2019 — Name </div>
        
        <v-spacer></v-spacer>

        <v-btn
          v-for="icon in icons"
          :key="icon"
          class="mx-3"
          icon
        >
          <v-icon class="black--text" size="24px">{{ icon }}</v-icon>
        </v-btn>
      </v-card-title>

 <v-card-actions class="grey darken-3 justify-center">
        &copy;2018 — <strong>Vuetify</strong>
      </v-card-actions>
     
    </v-card>
  </v-footer>
</template>

<script>
export default {
  data: () => ({
    icons: [
      "fab fa-instagram",
      "fab fa-facebook",
      "fab fa-youtube"
      /* 'fab fa-twitter',
        'fab fa-google-plus',
        'fab fa-linkedin',
         */
    ],
    links: [
        'PRIVACY POLICY', 
        'Team',
        'Contact Us'
      ]

  })
};
</script>