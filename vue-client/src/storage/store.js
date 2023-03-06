import {createStore} from 'vuex'
import axios from "axios";

const store = createStore({
    state() {
        return {
            user: {
                id: '',
                name: '',
                token: '',
            }
        }
    },

    mutations: {

        // authChecking() {
        //     if (this.state.user.token) {
        //         this.axios.defaults.headers.post['Authorization'] = `Bearer ${this.state.user.token}`;
        //         axios.post('http://127.0.0.1:8000/api/authChecking')
        //             .then(() => {
        //                 // if authenticated, do nothing
        //         }).catch(err => {
        //             this.$router.push({path: '/logout'})
        //             console.log((err))
        //         })
        //     } else {
        //         this.$router.push({path: '/logout'})
        //     }
        // },

        // extractUser() {
        //     this.state.user.id = localStorage.getItem('user_id')
        //     this.state.user.name = localStorage.getItem('user_name')
        //     this.state.user.token = localStorage.getItem('user_token')
        // },

        saveUser(state, payload) {
            localStorage.setItem('user_id', payload.id)
            localStorage.setItem('user_name', payload.name)
            localStorage.setItem('user_token', payload.token)

            this.state.user.id = payload.id
            this.state.user.name = payload.name
            this.state.user.token = payload.token
        },
    },
})

export default store
