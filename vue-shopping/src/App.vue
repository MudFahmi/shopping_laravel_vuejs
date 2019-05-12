<template>
  <v-app>
    
    <the-navbar />


    <v-content>
      <v-container>
      <router-view></router-view>
      </v-container>
    </v-content>

    <the-footer />
  </v-app>
</template>

<script>

/*import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
*/

import TheNavbar from '@/components/TheNavbar'
import TheFooter from '@/components/TheFooter'

export default {
  name: 'App',
  components: {
    TheNavbar,
    TheFooter
  },
  data () {
    return {
      
    }
  }
}
</script>
