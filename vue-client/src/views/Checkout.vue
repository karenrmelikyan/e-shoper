<template>
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input v-model="first_name" class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input v-model="last_name" class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input v-model="email" class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input v-model="mobile" class="form-control" type="text" placeholder="+123 456 789">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select v-model="country" class="custom-select">
                                <option selected>{{ country }}</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input v-model="address" class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input v-model="zip_code" class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <div v-for="product in products" class="d-flex justify-content-between">
                            <p>{{ product.title }}</p>
                            <p>{{ product.price * product.qty}}</p>
                        </div>
                        <hr class="mt-0">
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
                            <h5 class="font-weight-bold">{{ `$${this.subTotalPrice + 10}`}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Stripe</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <p class="help-block text-danger">{{ dangerMessage }}</p>
                        <button @click.prevent="order" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
</template>

<script>
import * as stripe from "stripe";

export default {
    name: "Checkout",

    data() {
        return {
            first_name: '',
            last_name: '',
            email: '',
            mobile: '',
            country: '',
            address: '',
            zip_code: '',
            dangerMessage: '',

            cartProducts: [],
            products: [],
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
        order() {
            if (!this.first_name) {
                this.dangerMessage = 'First name field cannot be empty'
            } else if(!this.last_name) {
                this.dangerMessage = 'Last name field cannot be empty'
            } else if(!this.email) {
                this.dangerMessage = 'Email field cannot be empty'
            } else if(!this.mobile) {
                this.dangerMessage = 'Mobile field cannot be empty'
            } else if(!this.country) {
                this.dangerMessage = 'Country field cannot be empty'
            } else if(!this.address) {
                this.dangerMessage = 'Address field cannot be empty'
            } else if(!this.zip_code) {
                this.dangerMessage = 'Zip code field cannot be empty'
            } else {
                 this.dangerMessage = ''
                this.axios.post(`${this.domain}/api/v1/order-create`, {
                    name: this.first_name,
                    surname: this.last_name,
                    email: this.email,
                    mobile: this.mobile,
                    country: this.country,
                    address: this.address,
                    zip_code: this.zip_code,
                    products: this.products,
                }).then(res => {
                    // After setting the webhook endpoint in the Stripe
                    // account, uncomment the rows bellow
                    //
                    // const sessionID = res.data.id
                    // stripe.redirectToCheckout({
                    //     sessionId: sessionID,
                    // });
                }).catch(err => {
                    this.dangerMessage = 'Something went wrong! Please try again'
                    console.log(err)
                })
            }
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
        },

        checkUserAuth() {
            const jwt = localStorage.getItem('jwt')
            if (jwt) {
                this.$store.commit('updateUserByToken', {
                    'token': jwt,
                    'axios': this.axios,
                    'domain': this.domain
                })
            } else {
                this.$store.commit('setPreviewsPath', {'path': '/checkout'})
                this.$router.push({'path': '/login'})
            }
        },

        fillFormFields() {
            this.first_name = this.$store.state.user?.name
            this.last_name = this.$store.state.user?.surname
            this.email = this.$store.state.user?.email
            this.mobile = this.$store.state.user?.mobile
            this.country = this.$store.state.user?.country
            this.address = this.$store.state.user?.address
            this.zip_code = this.$store.state.user?.zip_code
        },

    },

    mounted() {
        this.checkUserAuth()
        this.getCartProducts()
        this.fillFormFields()
    }
}
</script>
