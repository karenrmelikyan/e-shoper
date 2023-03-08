<template>
    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                    <tr v-for="product in products">
                        <td class="align-middle"><img :src="product.image_url" alt="" style="width: 50px;">{{ product.title }}</td>
                        <td class="align-middle">{{ `$${product.price}` }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button @click="minusProductCount(product.id)" class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center" :value="product.qty">
                                <div class="input-group-btn">
                                    <button @click="plusProductCount(product.id)" class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{ `$${product.price * product.qty}` }}</td>
                        <td @click="removeProduct(product.id)" class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{ `$${this.subTotalPrice}` }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{ `$${this.subTotalPrice + 10}` }}</h5>
                        </div>
                        <router-link to="/checkout">
                            <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
</template>

<script>
export default {
    name: "Cart",

    data() {
        return {
            products: [],
            cartProducts: [],
        }
    },

    computed: {
        subTotalPrice() {
            let subTotal = 0
            this.products.forEach(product => {
                subTotal += product.price * product.qty
            })
            return subTotal
        },
    },

    methods: {
        removeProduct(id) {
            for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].id === id) {
                    this.products.splice(i, 1)
                    break;
                }
            }

            for (let i = 0; i < this.cartProducts.length; i++) {
                if (this.cartProducts[i].id === id) {
                    this.cartProducts.splice(i, 1)
                    break;
                }
            }

            localStorage.setItem('cart', JSON.stringify(this.cartProducts))

            // update cart count in TopBar component
            this.$parent.$parent.$refs.header.$refs.topBar.updateCartCount();
        },

        plusProductCount(id) {
            this.products.forEach(product => {
                if (product.id === id) {
                    product.qty++;
                }
            })

            this.cartProducts.forEach(cartProduct => {
                if (cartProduct.id === id) {
                    cartProduct.qty++;

                    // increase cart count in TopBar component
                    this.$parent.$parent.$refs.header.$refs.topBar.cartCount++;
                }
            })

            localStorage.setItem('cart', JSON.stringify(this.cartProducts))
        },

        minusProductCount(id) {
            this.products.forEach(product => {
                if (product.id === id && product.qty > 1) {
                    product.qty--;
                }
            })

            this.cartProducts.forEach(cartProduct => {
                if (cartProduct.id === id && cartProduct.qty > 1) {
                    cartProduct.qty--;

                    // decrease cart count in TopBar component
                    this.$parent.$parent.$refs.header.$refs.topBar.cartCount--;
                }
            })

            localStorage.setItem('cart', JSON.stringify(this.cartProducts))
        },

        getCartProducts() {
            let IDs = []
            this.cartProducts = localStorage.getItem('cart')
            if (this.cartProducts) {
                // collect all ID from cart storage
                this.cartProducts = JSON.parse(this.cartProducts)
                this.cartProducts.forEach(product => {
                    IDs.push(product.id)
                })
                // get products from API by IDes
                this.axios.post(`${this.domain}/api/v1/get-cart-products`, {
                    'IDs': IDs
                }).then(res => {
                    this.products = res.data.data
                    // add qty key to products from cart storage
                    this.products.forEach(product => {
                       this.cartProducts.forEach(cartProduct => {
                           if (product.id === cartProduct.id) {
                               product.qty = cartProduct.qty
                           }
                       })
                   })
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    },

    mounted() {
        this.getCartProducts()
    }
}
</script>

<style scoped>

</style>
