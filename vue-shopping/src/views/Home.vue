<template>

 <v-layout row wrap>

    <v-flex v-for="product in products" :key="product.id" xs12 sm6 md4 >
      <v-card>
        <v-img
          class="white--text"
          height="200px"
          :src="product.imagePath"
        >
          <v-container fill-height fluid>
            <v-layout fill-height>
              <v-flex xs12 align-end flexbox>
                <span class="headline">{{product.title}}</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-img>
        <v-card-title>
          <div>
            <span class="grey--text">{{product.title}}</span><br>
            <span> {{product.description}}</span>
          </div>
        </v-card-title>
        <v-card-actions>
           
           <span class="grey--text"> {{product.price }} $ </span><br>
           <v-spacer></v-spacer>
           <v-btn flat v-on:click="addToCart(product)" > <v-icon> fas fa-cart-plus </v-icon> </v-btn>
        
        </v-card-actions>
      </v-card>
    </v-flex>

  </v-layout>

</template>

<script>

import axios from 'axios';

export default {
    components: {
    },


    data() {
      return {
        products:{},
      }
    },

    methods: {

      getProducts(){
        axios
          .get("http://127.0.0.1:8000/api/products")
          .then(response => {
            
            this.products = response.data.products
         
            console.log(this.products)
            
          })
          .catch(error => {
             console.log(error.response)
          })
          .finally(() => console.log("success"));
      },
      
      addToCart(product){

        product.count = 1

    if(! this.$cookies.isKey("cart")){
      this.$cookies.set("cart",product,60 * 60 * 12)
    }
    else{


    }


      console.log(this.$cookies.get("cart").title)
      }



      
    },

    mounted() {
      this.getProducts()
    },
  }
</script>
