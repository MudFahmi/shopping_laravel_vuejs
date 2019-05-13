<template>
  <div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <ul class="list-group">
          <li v-for="product in products" :key="product.id" class="list-group-item">
            <span class="badge">{{ product.count }}</span>
            <strong>{{ product.title }}</strong>
            <span class="label label-success">{{ product.price * product.count }}</span>


            <v-btn fab dark small color="yellow" @click="reduceOne(product.id)">
              <v-icon dark>fas fa-minus</v-icon>
            </v-btn>

            <v-btn fab dark small color="red" @click="reduceAll(product.id)">
              <v-icon dark>fas fa-broom</v-icon>
            </v-btn>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <strong>Total:</strong>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <a href="#" type="button" class="btn btn-success">Checkout</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: {}
    };
  },
  methods: {
    getCart() {
      this.products = JSON.parse(this.$cookies.get("cart"));
    },

    reduceOne(id){
         for (let i = 0; i < this.products.length; i++) {
          if (this.products[i].id === id) {
            this.products[i].count -= 1;
            if(this.products[i].count == 0)
            {
                this.products.splice(i, 1) 
            }
          }
        }

        this.$cookies.set("cart", JSON.stringify(this.products), 60 * 60 * 12);
    },

    reduceAll(id){
        for (let i = 0; i < this.products.length; i++) {
          if (this.products[i].id === id) {
                this.products.splice(i, 1) 
            
          }
        }

        this.$cookies.set("cart", JSON.stringify(this.products), 60 * 60 * 12);

    },


  },

  mounted() {
    this.getCart();
  }
};
</script>

<style>
</style>
