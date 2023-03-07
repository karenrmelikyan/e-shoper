import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../views/Home.vue')
        },

        {
            path: '/shop',
            name: 'shop',
            component: () => import('../views/Shop.vue')
        },

        {
            path: '/contact',
            name: 'contact',
            component: () => import('../views/Contact.vue')
        },

        {
            path: '/register',
            name: 'register',
            component: () => import('../views/Register.vue')
        },

        {
            path: '/login',
            name: 'login',
            component: () => import('../views/Login.vue')
        },

        {
            path: '/cart',
            name: 'cart',
            component: () => import('../views/Cart.vue')
        },

        {
            path: '/checkout',
            name: 'checkout',
            component: () => import('../views/Checkout.vue')
        },

        {
            path: '/product/:id',
            name: 'product',
            component: () => import('../views/Product.vue')
        },
    ]
})

export default router
