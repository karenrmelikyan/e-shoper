<template>
    <!-- Login Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sign In</span></h2>
        </div>
        <div id="success"></div>
        <div style="text-align: center;">
            <form style="display: inline-block;" >
                <div class="control-group">
                    <input type="email" v-model="email" class="form-control" placeholder="Your Email" autocomplete="email" required="required" />
                    <p></p>
                </div>
                <div class="control-group">
                    <input type="password" v-model="password" class="form-control" placeholder="Your Password" autocomplete="password" required="required" />
                    <p></p>
                </div>
                <div>
                    <p class="help-block text-danger">{{ dangerMessage }}</p>
                    <button @click.prevent="login" class="btn btn-primary py-2 px-4">Login</button>
                    <router-link to="/register" class="py-2 px-4">Registration</router-link>
                </div>
            </form>
        </div>
    </div>
    <!-- Login End -->
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            email: undefined,
            password: undefined,
            dangerMessage: '',
        }
    },

    methods: {
        login() {
            console.log(this.$store.state.previewsPath);
            if (!this.email) {
                this.dangerMessage = 'Email field cannot be empty'
            } else if(!this.password) {
                this.dangerMessage = 'Password field cannot be empty'
            } else {
                this.dangerMessage = ''
                this.axios.post(`${this.domain}/api/v1/login`, {
                    email: this.email,
                    password: this.password,
                }).then(res => {
                    localStorage.setItem('jwt', res.data.token)
                    this.$store.commit('setUser', res.data.user)
                    this.$router.push({path: this.$store.state.previewsPath})
                }).catch(err => {
                    this.dangerMessage = 'Your email or password probably wrong'
                    console.log(err)
                })
            }
        }
    },
}
</script>

