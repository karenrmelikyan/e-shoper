<template>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products"
                               v-model="q"
                               @keydown.enter.prevent="getSearchedProducts"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <router-link to="/cart" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">{{ cartCount }}</span>
                </router-link>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
</template>

<script>
export default {
    name: "Topbar",

    data() {
        return {
            cartCount: 0,
            q: '',
        }
    },

    methods: {
        updateCartCount() {
            this.cartCount = 0
            let productsInCart = localStorage.getItem('cart')
            if (productsInCart) {
                productsInCart = JSON.parse(productsInCart)
                productsInCart.forEach(product => {
                    this.cartCount += product.qty
                })
            }
        },

        getSearchedProducts() {
            this.axios.get(`${this.domain}/api/v1/products/q/${this.q}`)
                .then(res => {
                    this.$store.state.searchedProducts = res.data.data
                }).catch(err => {
                    console.log(err.message)
            })
        }
    },

    mounted() {
        this.updateCartCount()
    }

}
</script>

<style scoped>

</style>
