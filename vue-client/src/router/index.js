import {createRouter, createWebHistory} from 'vue-router'
import {defineAsyncComponent} from "vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [

        {
            path: '/',
            name: 'home',
            component: defineAsyncComponent(() => import('../views/Home.vue'))
        },

        {
            path: '/shop',
            name: 'shop',
            component: defineAsyncComponent(() => import('../views/Shop.vue'))
        },

        {
            path: '/contact',
            name: 'contact',
            component: defineAsyncComponent(() => import('../views/Contact.vue'))
        },


        {
            path: '/register',
            name: 'register',
            component: defineAsyncComponent(() => import('../views/Register.vue'))
        },

        {
            path: '/login',
            name: 'login',
            component: defineAsyncComponent(() => import('../views/Login.vue'))
        },

        {
            path: '/logout',
            name: 'logout',
            component: defineAsyncComponent(() => import('../views/Logout.vue'))
        },

        {
            path: '/cart',
            name: 'cart',
            component: defineAsyncComponent(() => import('../views/Cart.vue'))
        },

        {
            path: '/checkout',
            name: 'checkout',
            component: defineAsyncComponent(() => import('../views/Checkout.vue'))
        },

        {
            path: '/detail/:id',
            name: 'detail',
            component: defineAsyncComponent(() => import('../views/Detail.vue'))
        }
    ]
})

export default router
