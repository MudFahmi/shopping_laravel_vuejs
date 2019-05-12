<template>
  <div id="inspire">
    <v-toolbar 
    color="white" 
    fixed
    app
      :active.sync="Nav"
      :value="true"
      absolute
    >
     <!--  <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon> -->
      <v-toolbar-title>Logo Name</v-toolbar-title>
    
    <v-spacer></v-spacer>

      <v-btn
        color="teal"
        flat
        value="shopping"
      >
        <span>Shopping Cart </span>
       <i class="fas fa-shopping-cart"></i>
      </v-btn>

      <v-btn
        color="teal"
        flat
        value="signin"
      >
        <span>Sign in </span>
        <i class="fas fa-sign-in-alt"></i>
      </v-btn>

    
    </v-toolbar>
  </div>
</template>

<script>
export default {
  data: () => ({
    Nav: 'shopping'
  }),
  props: {
  
  }
};
</script>