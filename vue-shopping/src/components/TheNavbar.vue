<template>
  <div id="inspire">
    <v-toolbar color="white" fixed app :active.sync="Nav" :value="true" absolute>
      <!--  <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon> -->
      <v-toolbar-title>Logo Name</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn color="teal" flat value="shopping">

        <v-badge v-model="show" color="red" right>
          <template v-slot:badge>
            <span>{{cartCount}}</span>
          </template>

          <span>Shopping Cart</span>
          <i class="fas fa-shopping-cart"></i>
        </v-badge>
      </v-btn>

      <v-btn color="teal" flat value="signin">
        <span>Sign in</span>
        <i class="fas fa-sign-in-alt"></i>
      </v-btn>
    </v-toolbar>
  </div>
</template>

<script>
export default {

  computed: {

    cartCount(){
     if(this.$cookies.isKey("cart")){ 
      let count = JSON.parse(this.$cookies.get("cart")).length
      let products = JSON.parse(this.$cookies.get("cart"))
      if(count == 0){
        this.show = false
      }
      else {
        for(let i in products){
          this.count+=products[i].count
        }
        this.show = true
      }
     }
     else{
       this.count = 0
       this.show = false 
     }

     return this.count
    },  

  },

  data: () => ({
    Nav: "shopping",

    show:false,
    count:0,
  }),

  props: {}
};
</script>