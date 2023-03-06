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
                   this.$store.commit('saveUser', {'id': res.data.user.id, 'name': res.data.user.name, 'token': res.data.token})
                   //this.$router.push({path: '/account'})
                }).catch(err => {
                    this.dangerMessage = 'Your email or password probably wrong'
                    console.log(err)
                })
            }
        }
    },
}
</script>

