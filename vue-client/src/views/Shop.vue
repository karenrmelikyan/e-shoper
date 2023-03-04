<template>
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">

            <SidebarFilter ref="sidebar" @applied-filter="updateProducts" />

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>

                            <SortBy />
                        </div>
                    </div>

                    <div v-for="product in products" class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <router-link :to="{name: 'product', params: {id: product.id}}">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" :src="product.image_url" alt="">
                                </div>
                            </router-link>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ product.title }}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>{{ '$' + product.price }}</h6><h6 class="text-muted ml-2"><del>{{ '$' + (product.price * 1.2).toFixed(1)}}</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <button @click.prevent="addToCart(product.id)" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
</template>

<script>
import SidebarFilter from "../components/SidebarFilter.vue";
import SortBy from "../components/SortBy.vue";

export default {
    name: "Shop",

    components: {
        SidebarFilter,
        SortBy,
    },

    data() {
        return {
            products: []
        }
    },

    methods: {

        addToCart(id) {

            let newProduct = {
                    id,
                    qty: 1
                }

            let productsInCart = localStorage.getItem('cart')
            let needAddNewProduct = true

            if (productsInCart) {
                productsInCart = JSON.parse(productsInCart)
                productsInCart.forEach(product => {
                    if (product.id === id) {
                        product.qty++
                        needAddNewProduct = false
                    }
                })

                if (needAddNewProduct) {
                    productsInCart.push(newProduct)
                }

                localStorage.setItem('cart', JSON.stringify(productsInCart))

            } else {
                localStorage.setItem('cart', JSON.stringify([newProduct]))
            }

            // update count in cart in TopBar component
            this.$parent.$parent.$refs.header.$refs.topBar.updateCartCount();
        },

        updateProducts() {
            this.products = this.$refs.sidebar.products
        },

        getShopItems() {
            this.axios.get(`${this.domain}/api/v1/products/`)
                .then(res => {
                   this.products = res.data.data
                }).catch(err => {
                console.log(err)
            })
        }
    },

    mounted() {
       this.getShopItems()
    }
}
</script>

<style scoped>

</style>
