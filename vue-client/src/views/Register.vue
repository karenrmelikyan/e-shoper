<template>
    <!-- Register Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sign Up</span></h2>
        </div>
        <div id="success"></div>
        <div style="text-align: center;">
            <div style="display: inline-block;">
                <div class="control-group">
                    <input type="text" v-model="name" class="form-control"  placeholder="Name" autocomplete="name" required="required" />
                    <p></p>
                </div>
                <div class="control-group">
                    <input type="email" v-model="email" class="form-control"  placeholder="Email" autocomplete="email" required="required" />
                    <p></p>
                </div>
                <div class="control-group">
                    <input type="password" v-model="password" class="form-control" placeholder="Password" autocomplete="password" required="required" />
                    <p></p>
                </div>
                <div class="control-group">
                    <input type="password" v-model="password_confirm" class="form-control" placeholder="Confirm Password" autocomplete="confirm password" required="required" />
                </div>
                <div>
                    <p class="help-block text-danger">{{ dangerMessage }}</p>
                    <button @click.prevent="registration" class="btn btn-primary py-2 px-4" >Registration</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
</template>

<script>
export default {
    data() {
        return {
            name: undefined,
            email: undefined,
            password: undefined,
            password_confirm: undefined,
            dangerMessage: '',
        }
    },

    methods: {
        registration() {
            if (!this.name) {
                this.dangerMessage = 'Name field cannot be empty'
            } else if(!this.email) {
                this.dangerMessage = 'Email field cannot be empty'
            } else if(!this.password) {
                this.dangerMessage = 'Password field cannot be empty'
            } else if(!this.password_confirm) {
                this.dangerMessage = 'Confirm password field cannot be empty'
            } else if(this.password_confirm !== this.password) {
                this.dangerMessage = 'The password is not confirmed'
            } else {
                this.dangerMessage = ''
                this.axios.post(`${this.domain}/api/v1/register`, {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }).then(res => {
                    this.$store.commit('saveUser', {'id': res.data.user.id, 'name': res.data.user.name, 'token': res.data.token})
                    //this.$router.push({path: '/account'})
                }).catch(err => {
                    this.dangerMessage = 'Something went wrong! Try again please'
                    console.log(err)
                })
            }
        }
    },
}
</script>
