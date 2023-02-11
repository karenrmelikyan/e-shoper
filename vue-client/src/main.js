import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

axios.defaults.headers.post['Content-Type'] = 'application/json'
axios.defaults.headers.post['Accept'] = 'application/json'
//axios.defaults.headers.post['Authorization'] = `Bearer ${this.state.user.token}`;

const domain = 'http://127.0.0.1:8000'

const app = createApp(App)

app.use(router)
app.config.globalProperties.axios = axios
app.config.globalProperties.domain = domain

app.mount('#app')
