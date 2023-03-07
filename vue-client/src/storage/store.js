import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            user: undefined
        }
    },

    mutations: {
        setUser(state, payload) {
            this.state.user = payload
        },

        updateUserByToken(state, payload) {
            payload.axios.defaults.headers.post['Authorization'] = `Bearer ${payload.token}`;
            payload.axios.post(`${payload.domain}/api/v1/jwt-checking`)
                .then((res) => {
                    this.state.user = res.data.user
                }).catch(err => {
                console.log((err))
            })
        }
    },
})

export default store
