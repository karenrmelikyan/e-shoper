<template>
    <!-- Navbar -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                   data-toggle="collapse" href="#navbar-vertical"
                   style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
               <!-- Categories -->
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div v-for="category in categories" >
                            <a href="" @click.prevent="setCategoryProducts(category.id)"
                               :class="{ active: chosenCategoryID === category.id }"
                               class="nav-item nav-link">
                                {{ category.title }}
                            </a>
                        </div>
                    </div>
                </nav>
                <!-- / Categories -->
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <!-- Menu -->
                        <div class="navbar-nav mr-auto py-0">
                            <div v-for="menu in mainMenu">
                                <router-link
                                    :to="menu.uri"
                                    :class="{ active: this.$route.path === menu.uri }"
                                    class="nav-item nav-link"
                                >
                                    {{ menu.title }}
                                </router-link>
                            </div>
                        </div>
                        <!-- / Menu -->
                        <!-- account/login/register -->
                        <div v-if="this.$store.state.user" class="navbar-nav ml-auto py-0">
                            <div class="nav-item dropdown">
                                <div class="nav-link" data-toggle="dropdown">{{ this.$store.state.user.name }}
                                    <p class="fa fa-angle-down float-right py-1 px-2"></p>
                                </div>
                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                    <button @click.prevent="logout" class="dropdown-item">logout</button>
                                </div>
                            </div>
                        </div>
                        <div v-else class="navbar-nav ml-auto py-0">
                            <a href="" @click.prevent="login" class="nav-item nav-link">Login</a>
                            <a href=""  @click.prevent="register" class="nav-item nav-link">Register</a>
                        </div>
                        <!-- / account/login/register -->
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="src/assets/img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                        Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="src/assets/img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                                        Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- / Navbar -->
</template>

<script>
export default {
    name: "NavBar",

    data() {
        return {
            mainMenu: [
                { title: 'Home', uri: '/' },
                { title: 'Shop', uri: '/shop' },
                { title: 'Contact', uri: '/contact' },
            ],

            categories: [],
            chosenCategoryID: undefined,
        }
    },

    methods: {
        register() {
            // save previews path and redirect to register page
            this.$store.commit('setPreviewsPath', {'path': this.$route.path})
            this.$router.push({'path': '/register'})
        },

        login() {
            // save previews path and redirect to login page
            this.$store.commit('setPreviewsPath', {'path': this.$route.path})
            this.$router.push({'path': '/login'})
        },

        logout() {
            localStorage.setItem('jwt', '')
            this.$store.commit('setUser', undefined)
            this.$router.push({path: '/'})
        },

        setCategoryProducts(categoryID) {
            this.chosenCategoryID = categoryID
            this.axios.get(`${this.domain}/api/v1/products/category/${categoryID}`)
                .then(res => {
                    this.$store.commit('setCategoryProducts', res.data.data)
                }).catch(err => {
                console.log(err.message)
            })
        },

        getExistCategories() {
            this.axios.get(`${this.domain}/api/v1/categories`)
                .then(res => {
                    this.categories = res.data
                }).catch(err => {
                console.log(err.message)
            })
        },

        updateUserByToken() {
            const jwt = localStorage.getItem('jwt')
            if (jwt) {
                this.$store.commit('updateUserByToken', {
                    'token': jwt,
                    'axios': this.axios,
                    'domain': this.domain
                })
            }
        }
    },

    created() {
        this.getExistCategories()
    },

    mounted() {
        this.updateUserByToken()
    }
}
</script>

